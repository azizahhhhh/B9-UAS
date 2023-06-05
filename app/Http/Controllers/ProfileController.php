<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\ClientData;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\ProfileUpdateRequest;

class ProfileController extends Controller
{
    public function show()
    {   
        return view('auth.profile');
    }

    public function update(ProfileUpdateRequest $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required:email', 
            'nik' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'password' => 'required',
        ]);
        if(ClientData::where('user_id', auth()->user()->id)->exists()){
            ClientData::where('user_id', auth()->user()->id)->update([
                'nik' => $request->nik,
                'phone' => $request->phone,
                'address' => $request->address,
            ]);
        }else{
            ClientData::create([
                'user_id' => auth()->user()->id,
                'nik' => $request->nik,
                'phone' => $request->phone,
                'address' => $request->address,
            ]);
        }
        User::where('id', auth()->user()->id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            
        ]);

        return redirect()->back()->with('success', 'Profile updated.');
    }
}
