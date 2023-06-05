<?php

namespace App\Http\Controllers;

use App\Models\BahanBaku;
use App\Models\SupplierBahanBaku;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class SupplierBahanBakuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("pages.bahan-baku-supplier.index")->with([
            "bahan_bakus" => SupplierBahanBaku::with(["BahanBaku"])->whereUserId(Auth::user()->id)->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("pages.bahan-baku-supplier.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            "name" => "required",
            "image" => "required|image|mimes:png,jpg,jpeg|max:5000",
            "price" => "required|integer",
            "quantity" => "required|integer",
            "description" => "required",
            "available" => "required",
        ]);

        DB::beginTransaction();
        try {
            $bahan_baku = BahanBaku::firstOrCreate([
                "name" => Str::title($request->name),
            ]);

            if ($this->alreadyHaveRawProduct($bahan_baku->id)) {
                DB::rollBack();
                return redirect()->back()->with("error", "Maaf, Anda telah memiliki data ini sebelumnya");
            }
            $supplier_bahan_baku = SupplierBahanBaku::create([
                "user_id" => Auth::user()->id,
                "bahan_baku_id" => $bahan_baku->id,
                "price" => $request->price,
                "quantity" => $request -> quantity,
                "description" => $request->description,
                "available" => $request->available
            ]);
            $supplier_bahan_baku->addMediaFromRequest("image")->toMediaCollection("gambar-bahan-baku");
            DB::commit();
            return redirect()->route("supplier-bahan-baku.index")->with("success", "Data berhasil ditambahkan");
        } catch (Exception $e) {
            dd($e->getMessage());
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(SupplierBahanBaku $supplierBahanBaku)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SupplierBahanBaku $supplierBahanBaku)
    {
        return view("pages.bahan-baku-supplier.edit")->with([
            "supplier_bahan_baku" => $supplierBahanBaku
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SupplierBahanBaku $supplierBahanBaku)
    {
        $request->validate([
            "name" => "required",
            "image" => "required|image|mimes:png,jpg,jpeg|max:5000",
            "price" => "required|integer",
            "quantity" => "required|integer",
            "description" => "required",
            "available" => "required",
        ]);
        
        DB::beginTransaction();
        try {
            $bahan_baku = BahanBaku::whereName(Str::title($request->name))->first();
            if ($this->alreadyHaveRawProduct($bahan_baku->id) && $supplierBahanBaku->BahanBaku->name != $bahan_baku->name) {
                DB::rollBack();
                return redirect()->back()->with('error', "Nama barang telah digunakan");
            }
            $bahan_baku = BahanBaku::firstOrCreate([
                "name" => Str::title($request->name),
            ]);
            $supplierBahanBaku->update([
                "user_id" => $supplierBahanBaku->user->id,
                "bahan_baku_id" => $bahan_baku->id,
                "price" => $request->price,
                "quantity" => $request->quantity,
                "description" => $request->description,
                "available" => $request->available
            ]);
            if ($request->has("image")) {
                $supplierBahanBaku->clearMediaCollection("gambar-bahan-baku");
                $supplierBahanBaku->addMediaFromRequest("image")->toMediaCollection("gambar-bahan-baku");
            }
            DB::commit();
            return redirect()->route("supplier-bahan-baku.index")->with("success", "Data berhasil diperbarui");

        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SupplierBahanBaku $supplierBahanBaku)
    {
        $supplierBahanBaku->delete();
        return redirect()->route("supplier-bahan-baku.index")->with("success", "Data berhasil dihapus");
    }
    private function alreadyHaveRawProduct($product_id)
    {
        return SupplierBahanBaku::whereUserId(Auth::user()->id)->whereBahanBakuId($product_id)->exists();
    }
}
