<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BahanBaku;
use App\Models\SupplierPemasukan;
use App\Models\User;
use Carbon\Carbon;


class LaporanKeuanganSupplierController extends Controller
{
    private $param;
    public function __construct(){
        $this->middleware(['role:Supplier']);
    }

    public function index(Request $request){
        try {

            $userId = $request->User()->id;

            $this->param['getSellingJanuary'] = SupplierPemasukan::whereMonth('date', '01')->where('user_id', $userId)->sum('selling');
            $this->param['getSellingFebruary'] = SupplierPemasukan::whereMonth('date', '02')->where('user_id', $userId)->sum('selling');
            $this->param['getSellingMarch'] = SupplierPemasukan::whereMonth('date', '03')->where('user_id', $userId)->sum('selling');
            $this->param['getSellingApril'] = SupplierPemasukan::whereMonth('date', '04')->where('user_id', $userId)->sum('selling');
            $this->param['getSellingMay'] = SupplierPemasukan::whereMonth('date', '05')->where('user_id', $userId)->sum('selling');
            $this->param['getSellingJune'] = SupplierPemasukan::whereMonth('date', '06')->where('user_id', $userId)->sum('selling');
            $this->param['getSellingJuly'] = SupplierPemasukan::whereMonth('date', '07')->where('user_id', $userId)->sum('selling');
            $this->param['getSellingAugust'] = SupplierPemasukan::whereMonth('date', '08')->where('user_id', $userId)->sum('selling');
            $this->param['getSellingSeptember'] = SupplierPemasukan::whereMonth('date', '09')->where('user_id', $userId)->sum('selling');
            $this->param['getSellingOctober'] = SupplierPemasukan::whereMonth('date', '10')->where('user_id', $userId)->sum('selling');
            $this->param['getSellingNovember'] = SupplierPemasukan::whereMonth('date', '11')->where('user_id', $userId)->sum('selling');
            $this->param['getSellingDecember'] = SupplierPemasukan::whereMonth('date', '12')->where('user_id', $userId)->sum('selling');

            $this->param['getIncomeJanuary'] = SupplierPemasukan::whereMonth('date', '01')->where('user_id', $userId)->sum('income');
            $this->param['getIncomeFebruary'] = SupplierPemasukan::whereMonth('date', '02')->where('user_id', $userId)->sum('income');
            $this->param['getIncomeMarch'] = SupplierPemasukan::whereMonth('date', '03')->where('user_id', $userId)->sum('income');
            $this->param['getIncomeApril'] = SupplierPemasukan::whereMonth('date', '04')->where('user_id', $userId)->sum('income');
            $this->param['getIncomeMay'] = SupplierPemasukan::whereMonth('date', '05')->where('user_id', $userId)->sum('income');
            $this->param['getIncomeJune'] = SupplierPemasukan::whereMonth('date', '06')->where('user_id', $userId)->sum('income');
            $this->param['getIncomeJuly'] = SupplierPemasukan::whereMonth('date', '07')->where('user_id', $userId)->sum('income');
            $this->param['getIncomeAugust'] = SupplierPemasukan::whereMonth('date', '08')->where('user_id', $userId)->sum('income');
            $this->param['getIncomeSeptember'] = SupplierPemasukan::whereMonth('date', '09')->where('user_id', $userId)->sum('income');
            $this->param['getIncomeOctober'] = SupplierPemasukan::whereMonth('date', '10')->where('user_id', $userId)->sum('income');
            $this->param['getIncomeNovember'] = SupplierPemasukan::whereMonth('date', '11')->where('user_id', $userId)->sum('income');
            $this->param['getIncomeDecember'] = SupplierPemasukan::whereMonth('date', '12')->where('user_id', $userId)->sum('income');

            $bahanBaku = SupplierPemasukan::all();
            $this->param['countIngredients'] = $bahanBaku->where('user_id', $userId)->sum('selling');
            $this->param['countIncome'] = $bahanBaku->where('user_id', $userId)->sum('income');


            return view('pages.rekap-laporan-keuangan.laporan-keuangan-supplier', $this->param);
        } catch (\Exception $e) {
            return redirect()->back()->withError($e->getMessage());
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->withError('Terjadi kesalahan pada database', $e->getMessage());
        }
    }
}

