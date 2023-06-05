<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BahanBaku;
use App\Models\PemilikPemasukan;
use App\Models\PemilikPengeluaran;
use Carbon\Carbon;


class LaporanKeuanganOwnerController extends Controller
{
    private $param;
    public function __construct(){
        $this->middleware(['role:Pemilik Usaha']);
    }

    public function index(){
        try {

            $this->param['getJanuary'] = PemilikPemasukan::whereMonth('date', '01')->sum('selling');
            $this->param['getFebruary'] = PemilikPemasukan::whereMonth('date', '02')->sum('selling');
            $this->param['getMarch'] = PemilikPemasukan::whereMonth('date', '03')->sum('selling');
            $this->param['getApril'] = PemilikPemasukan::whereMonth('date', '04')->sum('selling');
            $this->param['getMay'] = PemilikPemasukan::whereMonth('date', '05')->sum('selling');
            $this->param['getJune'] = PemilikPemasukan::whereMonth('date', '06')->sum('selling');
            $this->param['getJuly'] = PemilikPemasukan::whereMonth('date', '07')->sum('selling');
            $this->param['getAugust'] = PemilikPemasukan::whereMonth('date', '08')->sum('selling');
            $this->param['getSeptember'] = PemilikPemasukan::whereMonth('date', '09')->sum('selling');
            $this->param['getOctober'] = PemilikPemasukan::whereMonth('date', '10')->sum('selling');
            $this->param['getNovember'] = PemilikPemasukan::whereMonth('date', '11')->sum('selling');
            $this->param['getDecember'] = PemilikPemasukan::whereMonth('date', '12')->sum('selling');

            $this->param['getThisJanuary'] = PemilikPemasukan::whereMonth('date', '01')->sum('income');
            $this->param['getThisFebruary'] = PemilikPemasukan::whereMonth('date', '02')->sum('income');
            $this->param['getThisMarch'] = PemilikPemasukan::whereMonth('date', '03')->sum('income');
            $this->param['getThisApril'] = PemilikPemasukan::whereMonth('date', '04')->sum('income');
            $this->param['getThisMay'] = PemilikPemasukan::whereMonth('date', '05')->sum('income');
            $this->param['getThisJune'] = PemilikPemasukan::whereMonth('date', '06')->sum('income');
            $this->param['getThisJuly'] = PemilikPemasukan::whereMonth('date', '07')->sum('income');
            $this->param['getThisAugust'] = PemilikPemasukan::whereMonth('date', '08')->sum('income');
            $this->param['getThisSeptember'] = PemilikPemasukan::whereMonth('date', '09')->sum('income');
            $this->param['getThisOctober'] = PemilikPemasukan::whereMonth('date', '10')->sum('income');
            $this->param['getThisNovember'] = PemilikPemasukan::whereMonth('date', '11')->sum('income');
            $this->param['getThisDecember'] = PemilikPemasukan::whereMonth('date', '12')->sum('income');

            $this->param['getPengeluaranJanuary'] = PemilikPengeluaran::whereMonth('date', '01')->sum('pengeluaran');
            $this->param['getPengeluaranFebruary'] = PemilikPengeluaran::whereMonth('date', '02')->sum('pengeluaran');
            $this->param['getPengeluaranMarch'] = PemilikPengeluaran::whereMonth('date', '03')->sum('pengeluaran');
            $this->param['getPengeluaranApril'] = PemilikPengeluaran::whereMonth('date', '04')->sum('pengeluaran');
            $this->param['getPengeluaranMay'] = PemilikPengeluaran::whereMonth('date', '05')->sum('pengeluaran');
            $this->param['getPengeluaranJune'] = PemilikPengeluaran::whereMonth('date', '06')->sum('pengeluaran');
            $this->param['getPengeluaranJuly'] = PemilikPengeluaran::whereMonth('date', '07')->sum('pengeluaran');
            $this->param['getPengeluaranAugust'] = PemilikPengeluaran::whereMonth('date', '08')->sum('pengeluaran');
            $this->param['getPengeluaranSeptember'] = PemilikPengeluaran::whereMonth('date', '09')->sum('pengeluaran');
            $this->param['getPengeluaranOctober'] = PemilikPengeluaran::whereMonth('date', '10')->sum('pengeluaran');
            $this->param['getPengeluaranNovember'] = PemilikPengeluaran::whereMonth('date', '11')->sum('pengeluaran');
            $this->param['getPengeluaranDecember'] = PemilikPengeluaran::whereMonth('date', '12')->sum('pengeluaran');

            $this->param['getKebutuhanJanuary'] = PemilikPengeluaran::whereMonth('date', '01')->sum('kebutuhan');
            $this->param['getKebutuhanFebruary'] = PemilikPengeluaran::whereMonth('date', '02')->sum('kebutuhan');
            $this->param['getKebutuhanMarch'] = PemilikPengeluaran::whereMonth('date', '03')->sum('kebutuhan');
            $this->param['getKebutuhanApril'] = PemilikPengeluaran::whereMonth('date', '04')->sum('kebutuhan');
            $this->param['getKebutuhanMay'] = PemilikPengeluaran::whereMonth('date', '05')->sum('kebutuhan');
            $this->param['getKebutuhanJune'] = PemilikPengeluaran::whereMonth('date', '06')->sum('kebutuhan');
            $this->param['getKebutuhanJuly'] = PemilikPengeluaran::whereMonth('date', '07')->sum('kebutuhan');
            $this->param['getKebutuhanAugust'] = PemilikPengeluaran::whereMonth('date', '08')->sum('kebutuhan');
            $this->param['getKebutuhanSeptember'] = PemilikPengeluaran::whereMonth('date', '09')->sum('kebutuhan');
            $this->param['getKebutuhanOctober'] = PemilikPengeluaran::whereMonth('date', '10')->sum('kebutuhan');
            $this->param['getKebutuhanNovember'] = PemilikPengeluaran::whereMonth('date', '11')->sum('kebutuhan');
            $this->param['getKebutuhanDecember'] = PemilikPengeluaran::whereMonth('date', '12')->sum('kebutuhan');

            // $this->param['grafikPemasukan'] = whereMonth('date')->sum('income');
            $bahanBaku = PemilikPemasukan::all();
            $this->param['countPemasukan'] = $bahanBaku->sum('income');
            $this->param['countCup'] = $bahanBaku->sum('selling');

            $kebutuhanBahanBaku = PemilikPengeluaran::all();
            $this->param['countPengeluaran'] = $kebutuhanBahanBaku->sum('pengeluaran');
            $this->param['countKebutuhan'] = $kebutuhanBahanBaku->sum('kebutuhan');


            return view('pages.rekap-laporan-keuangan.laporan-keuangan-owner', $this->param);
        } catch (\Exception $e) {
            return redirect()->back()->withError($e->getMessage());
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->withError('Terjadi kesalahan pada database', $e->getMessage());
        }
    }
}

