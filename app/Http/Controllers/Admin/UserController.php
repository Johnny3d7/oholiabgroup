<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Employe;
use App\Models\Entreprise;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $entreprises = Entreprise::all();
        $roles = Role::all();
        $permissions = Permission::all();
        $employes = Employe::all();
        return view('admin.users.create', compact('entreprises', 'employes', 'roles', 'permissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|unique:users',
            'email' => 'required|email',
            'id_roles' => 'required|exists:roles,id'
        ],[
            'username.required' => "Le nom d'utilisateur est un champs obligatoire",
            'username.unique' => "Ce nom d'utilisateur est déjà attribué !",
            'email.required' => "L'adresse mail est un champs obligatoire",
            'email.email' => "Veuillez fournir une email correcte de la forme example@domain.xx",
            'id_roles.required' => "Veuillez sélectionner le rôle de l'utilisateur",
            'id_roles.exists' => "Le rôle que vous avez sélectionné n'existe pas",
        ]);
        $user = User::create([
            'username' => $request->username,
            'email'=> $request->email,
            'password' => Hash::make('1234567890'),
            // 'id_entreprise' => $entreprises[$i]
        ]);

        $user->assignRole(Role::find($request->id_roles)->name);
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        // dd($user);
        // dd($user->hasPermissionTo('show_module_page'));
        // dd($user->roles[0], $user->roles[0]->permissions, $user->permissions, $user->perms());
        // dd($user->roles()->get(), $user->role, $user->role->permissions()->get(), $user->permissions(), $user->hasRole(config('constants.roles.superadmin')), $user->hasPermissionTo("Show Aministration"));
        return view('admin.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'username' => 'required',
        ]);

        $user->update(['username' => $request->username]);

        if ($image = $request->file('image')) {
            $name = $request->name;
            $fileName = str_replace(' ', '_', $name) . '_' . time() . '.' . $image->extension();
            $path = $image->storeAs('Products', $fileName, 'public');
            $user->image = 'storage/' . $path;
            $user->save();
        }

        $notification = array(
            "message" => "Compte utilisateur mis à jour avec succès !",
            "alert-type" => "success"
        );

        return redirect()->back()->with($notification);
    }

    public function updatePassword(Request $request, User $user)
    {
        $request->validate([
            'password' => 'required|min:8|confirmed',
        ]);

        $user->update(['password' => Hash::make($request->password)]);

        $notification = array(
            "message" => "Mot de passe de l'utilisateur mis à jour avec succès !",
            "alert-type" => "success"
        );

        return redirect()->back()->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
