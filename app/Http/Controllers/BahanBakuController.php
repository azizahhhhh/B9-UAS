<?php

namespace App\Http\Controllers;

use App\Models\BahanBaku;
use App\Models\PemilikBahanBaku;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class BahanBakuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("pages.bahan-baku-owner.index")->with([
            "bahan_bakus" => PemilikBahanBaku::with(["BahanBaku"])->whereUserId(Auth::user()->id)->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("pages.bahan-baku-owner.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            "name" => "required",
            "quantity" => "required|integer",
            
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
            $pemilik_bahan_baku = PemilikBahanBaku::create([
                "user_id" => Auth::user()->id,
                "bahan_baku_id" => $bahan_baku->id,
                "quantity" => $request->quantity
            ]);
            DB::commit();
            return redirect()->route("pemilik-bahan-baku.index")->with("success", "Data berhasil ditambahkan");
        } catch (Exception $e) {
            dd($e->getMessage());
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(PemilikBahanBaku $bahanBaku)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PemilikBahanBaku $pemilikBahanBaku)
    {
        return view("pages.bahan-baku-owner.edit")->with([
            "pemilik_bahan_baku" => $pemilikBahanBaku
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PemilikBahanBaku $pemilikBahanBaku)
    {
        $request->validate([
            "name" => "required",
            "quantity" => "required|integer"
        ]);



        DB::beginTransaction();
        try {
            $bahan_baku = BahanBaku::whereName(Str::title($request->name))->first();
            if ($this->alreadyHaveRawProduct($bahan_baku->id) && $pemilikBahanBaku->BahanBaku->name != $bahan_baku->name) {
                DB::rollBack();
                return redirect()->back()->with('error', "Nama barang telah digunakan");
            }
            $bahan_baku = BahanBaku::firstOrCreate([
                "name" => Str::title($request->name),
            ]);

            $pemilikBahanBaku->update([
                "bahan_baku_id" => $bahan_baku->id,
                "quantity" => $request->quantity
            ]);
            // if ($request->has("image")) {
            //     $pemilikBahanBaku->clearMediaCollection("gambar-bahan-baku");
            //     $pemilikBahanBaku->addMediaFromRequest("image")->toMediaCollection("gambar-bahan-baku");
            // }
            DB::commit();
            return redirect()->route("pemilik-bahan-baku.index")->with("success", "Data berhasil ditambahkan");
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PemilikBahanBaku $pemilikBahanBaku)
    {
        $pemilikBahanBaku->delete();
        return redirect()->route("pemilik-bahan-baku.index")->with("success", "Data berhasil dihapus");
    }

    private function alreadyHaveRawProduct($product_id)
    {
        return PemilikBahanBaku::whereUserId(Auth::user()->id)->whereBahanBakuId($product_id)->exists();
    }
}
