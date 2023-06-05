<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\BahanBaku;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\PemilikPengeluaran;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PemilikPengeluaranController extends Controller
{
    //
    public function index()
    {
        return view("pages.pengeluaran-pemilik.index")->with([
            "pemilik_pengeluarans" => PemilikPengeluaran::whereUserId(Auth::user()->id)->get()
        ]);
    }
    public function create()
    {
        return view("pages.pengeluaran-pemilik.create");
    }
    public function store(Request $request)
    {
        $request->validate([
            "date" => "required",
            "name" => "required",
            "pengeluaran" => "required|integer",
            "kebutuhan" => "required|integer"
        ]);

        DB::beginTransaction();
        try {
            $bahan_baku = BahanBaku::firstOrCreate([
                "name" => Str::title($request->name),
            ]);
            $bahan_baku;
            PemilikPengeluaran::create([
                "user_id" => Auth::user()->id,
                "date" => $request->date,
                "bahan_baku_id" => $bahan_baku->id,
                "pengeluaran" => $request->pengeluaran,
                "kebutuhan" => $request->kebutuhan
            ]);
            DB::commit();
            return redirect()->route("pemilik-pengeluaran.index")->with("success", "Data berhasil ditambahkan");
        } catch (Exception $e) {
            dd($e->getMessage());
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
    public function edit(PemilikPengeluaran $pemilikPengeluaran)
    {
        return view("pages.pengeluaran-pemilik.edit")->with([
            "pemilik_pengeluaran" => $pemilikPengeluaran
        ]);
    }
    public function update(Request $request, PemilikPengeluaran $pemilikPengeluaran)
    {
        $request->validate([
            "date" => "required",
            "name" => "required",
            "kebutuhan" => "required|integer",
            "pengeluaran" => "required|integer"
        ]);


        DB::beginTransaction();
        try {
            $bahan_baku = BahanBaku::firstOrCreate([
                "name" => Str::title($request->name),
            ]);

            $pemilikPengeluaran->update([
                "date" => $request->date,
                "bahan_baku_id" => $bahan_baku->id,
                "kebutuhan" => $request->kebutuhan,
                "pengeluaran" => $request->pengeluaran
            ]);
            DB::commit();
            return redirect()->route("pemilik-pengeluaran.index")->with("success", "Data berhasil ditambahkan");
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
