<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use App\Models\PemilikPemasukan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PemilikPemasukanController extends Controller
{
    public function index(){
        return view('pages.pemasukan-pemilik.index')->with([
            "pemilik_pemasukans" => PemilikPemasukan::all()
        ]);
    }
    public function create(){
        return view('pages.pemasukan-pemilik.create');
    }
    public function store(Request $request){
        $request->validate([
            "date" => "required",
            "selling" => "required|integer",
            "income" => "required|integer"
        ]);

        DB::beginTransaction();
        try {
            PemilikPemasukan::create([
                "user_id" => auth()->user()->id,
                "date" => $request->date,
                "selling" => $request->selling,
                "income" => $request->income
            ]);
            DB::commit();
            return redirect()->route("pemilik-pemasukan.index")->with("success", "Data berhasil ditambahkan");
        } catch (Exception $e) {
            dd($e->getMessage());
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
    public function edit(PemilikPemasukan $pemilikPemasukan){
        return view("pages.pemasukan-pemilik.edit")->with([
            "pemilik_pemasukan" => $pemilikPemasukan
        ]);
    }
    public function update(Request $request, PemilikPemasukan $pemilikPemasukan)
    {
        // dd($supplierPemasukan);
        $request->validate([
            "date" => "required",
            "selling" => "required|integer",
            "income" => "required|integer"
        ]);


        DB::beginTransaction();
        try {

            $pemilikPemasukan->update([
                "date" => $request->date,
                "selling" => $request->selling,
                "income" => $request->income
            ]);
            DB::commit();
            return redirect()->route("pemilik-pemasukan.index")->with("success", "Data berhasil ditambahkan");
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
