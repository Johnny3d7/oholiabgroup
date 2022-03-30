<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Auth;

class UserController extends Controller
{
    //
    function checkuser(Request $request){
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ],
        [
            'username.required'=>"Le nom d'utilidateur est un champ requis",
            'password.required'=>"Le mot de passe est un champ requis"
        ]);

        $creds = $request->only('username','password');
        if (Auth::guard('web')->attempt($creds)) {
            return redirect()->route('module.index');
        }
        else{
            $old = ['username' => $request->username,'password' => $request->password];
            if(User::whereUsername($request->username)->first()){
                $msg = ['password' => "Le mot de passe saisi est incorrect"];
            } else {
                $msg = ['username' => "Le nom d'utilisateur saisi est incorrect"];
            }
            session()->flash('old', $old);
            return redirect()->route('login')->withErrors($msg);
        }
    }
}
