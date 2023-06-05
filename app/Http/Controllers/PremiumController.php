<?php

namespace App\Http\Controllers;

use App\Models\AkunPremiumNew;
use App\Models\SyaratPremiumAkun;
use Illuminate\Http\Request;

class PremiumController extends Controller
{
    public function index(){
        try {
            $syarat = SyaratPremiumAkun::first();
            return view('pages.syarat-akun-premium.index', [
                'syarat' =>$syarat
            ]);
        } catch(\Throwable $e){
            return redirect()->back()->withError($e->getMessage());
        } catch(\Illuminate\Database\QueryException $e){
            return redirect()->back()->withError($e->getMessage());
        }

    }
    public function store(){
        try {
            AkunPremiumNew::create([
                'user_id' => auth()->user()->id,
                'status' => false
            ]);
            return back()->with('success','Permintaan akun premium sukses dikirm');
        } catch(\Throwable $e){
            return redirect()->back()->withError($e->getMessage());
        } catch(\Illuminate\Database\QueryException $e){
            return redirect()->back()->withError($e->getMessage());
        }
    }
}
