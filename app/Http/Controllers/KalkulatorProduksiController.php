<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KalkulatorProduksiController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['role:Pemilik Usaha']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('pages.kalkulator-produksi.index');
    }

    public function perkalian(Request $request)
    {
        try {
            $angka1 = $request->input('bahan_baku');
            $angka2 = $request->input('jumlah_eskrim');
            $this->param['bahan_baku'] = $angka1;
            $this->param['jumlah_eskrim'] = $angka2;
            $this->param['hasil'] = $angka1 * $angka2;

            return view('pages.kalkulator-produksi.index', $this->param);
            //code...
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}
