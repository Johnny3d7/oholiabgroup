<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    //
    function checkuser(Request $request)
    {
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
            $user = \Auth::user();
            $user_role = $user->roles->first();
            return redirect()->route($user_role ? $user_role->home()['name'] : 'modules.index');
        }
        else{
            $old = ['username' => $request->username,'password' => $request->password];
            if(User::whereUsername($request->username)->first()){ // || User::whereEmail($request->username)->first()
                $msg = ['password' => "Le mot de passe saisi est incorrect"];
            } else {
                $msg = ['username' => "Le nom d'utilisateur saisi est incorrect"];
            }
            session()->flash('old', $old);
            return redirect()->route('login')->withErrors($msg);
        }
    }

    public function profile()
    {
        dd('here');
        $user = \Auth::user();
        return view('admin.users.show', compact('user'), ['profile' => true]);
    }

    public function update(Request $request)
    {
        $user = \Auth::user();
        $request->validate([
            'username' => 'required|min:3',
        ]);

        $user->update(['username' => $request->username]);

        if ($image = $request->file('image')) {
            $name = $user->username;
            $fileName = str_replace(' ', '_', $name) . '_' . time() . '.' . $image->extension();
            $path = $image->storeAs('Profiles', $fileName, 'public');
            $user->image = 'storage/' . $path;
            $user->save();
        }

        $notification = array(
            "message" => "Votre compte a été mis à jour avec succès !",
            "alert-type" => "success"
        );

        return redirect()->back()->with($notification)->with(['profile' => true]);

    }

    public function password(Request $request)
    {
        $user = \Auth::user();
        if(!Hash::check($request->old_password, $user->password)) return back()->with(['profile' => true])->withInput()->withErrors(['old_password' => ['Incorrect password']]);
        $request->validate([
            'old_password' => 'required',
            'password' => 'required|min:8|confirmed',
        ]);

        $user->update(['password' => Hash::make($request->password)]);

        $notification = array(
            "message" => "Votre mot de passe a été mis à jour avec succès !",
            "alert-type" => "success"
        );

        return redirect()->back()->with($notification)->with(['profile' => true]);

    }
}
