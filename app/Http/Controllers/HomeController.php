<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\AkunPremium;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if(auth()->user()->is_premium){
            $akun = AkunPremium::where('user_id', auth()->user()->id)->get();
            $expired_date = $akun[0]->expired_date;
            return view('home', [
                'expired_date' => $expired_date
            ]);
        }else{
            return view('home');
        }
    }
}
