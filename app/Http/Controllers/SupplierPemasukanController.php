<?php

namespace App\Http\Controllers;

use App\Models\SupplierPemasukan;
use Illuminate\Http\Request;
use App\Models\BahanBaku;
use App\Models\PemilikBahanBaku;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class SupplierPemasukanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // return view("pages.pemasukan-supplier.index")->with([
        //     "bahan_bakus" => BahanBaku::with(["BahanBaku"])->whereUserId(Auth::user()->id)->get()
        // ]);
        // dd('cek');
        return view("pages.pemasukan-supplier.index")->with([
            "supplier_pemasukans" => SupplierPemasukan::whereUserId(Auth::user()->id)->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("pages.pemasukan-supplier.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            "date" => "required",
            "name" => "required",
            "selling" => "required|integer",
            "income" => "required|integer"
        ]);

        DB::beginTransaction();
        try {
            $bahan_baku = BahanBaku::firstOrCreate([
                "name" => Str::title($request->name),
            ]);
            $bahan_baku;
            SupplierPemasukan::create([
                "user_id" => Auth::user()->id,
                "date" => $request->date,
                "bahan_baku_id" => $bahan_baku->id,
                "selling" => $request->selling,
                "income" => $request->income
            ]);
            DB::commit();
            return redirect()->route("supplier-pemasukan.index")->with("success", "Data berhasil ditambahkan");
        } catch (Exception $e) {
            dd($e->getMessage());
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(SupplierPemasukan $supplierPemasukan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SupplierPemasukan $supplierPemasukan)
    {
        return view("pages.pemasukan-supplier.edit")->with([
            "supplier_pemasukan" => $supplierPemasukan
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SupplierPemasukan $supplierPemasukan)
    {
        // dd($supplierPemasukan);
        $request->validate([
            "date" => "required",
            "name" => "required",
            "selling" => "required|integer",
            "income" => "required|integer"
        ]);


        DB::beginTransaction();
        try {
            $bahan_baku = BahanBaku::firstOrCreate([
                "name" => Str::title($request->name),
            ]);

            $supplierPemasukan->update([
                "date" => $request->date,
                "bahan_baku_id" => $bahan_baku->id,
                "selling" => $request->selling,
                "income" => $request->income
            ]);
            DB::commit();
            return redirect()->route("supplier-pemasukan.index")->with("success", "Data berhasil ditambahkan");
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    // public function destroy(SupplierPemasukan $supplierPemasukan)
    // {
    //     $supplierPemasukan->delete();
    //     return redirect()->route("supplier-pemasukan.index")->with("success", "Data berhasil dihapus");
    // }
}
