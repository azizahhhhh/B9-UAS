<?php

namespace App\Http\Controllers;

use App\Models\SyaratPremiumAkun;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $syarat = SyaratPremiumAkun::first();
        return view('welcome2', [
            'syarat' => $syarat->body
        ]);
    }
}
