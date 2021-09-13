<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

class UserController extends Controller
{
    //
    function checkuser(Request $request){
        $request->validate([
            'username' => 'required',
            'password' => 'required|min:8|max:30'
        ],
        [
            'username.required'=>"Le nom d'utilidateur est un champ requis",
            'password.min' => "Le mot de passe doit avoir au moins 8 caractères",
            'password.required'=>"Le mot de passe est un champ requis"
        ]);

        $creds = $request->only('username','password');
        if (Auth::guard('web')->attempt($creds)) {
            return redirect()->route('module.index');
        }
        else{
            return redirect()->route('login');
        }
    }
}
