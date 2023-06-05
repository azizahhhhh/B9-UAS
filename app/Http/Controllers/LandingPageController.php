<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LandingPageController extends Controller
{
    public function index(Request $request){
        $data = [
            'title' => 'GETCO',
            'header' => 'Welcome To Getco',
        ];
        
        return view('layouts.landingpage', [
            'data' => $data
        ]);
    }
}
