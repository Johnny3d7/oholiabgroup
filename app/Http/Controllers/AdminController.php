<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Entrepot;
use App\Models\Entreprise;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
    public function update(Request $request, $id)
    {
        //
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

    public function iconsIndex()
    {
        return view('admin.icons');
    }

    /*--------------------------------------------- Users Routes ------------------------------------------------ */
    public function usersIndex()
    {
        $users = User::all();
        // dd($users[0]->entreprise);
        return view('admin.role_permission.users.index', compact('users'));
    }
    
    public function usersCreate()
    {
        $entreprises = Entreprise::all();
        $roles = Role::all();
        $permissions = Permission::all();
        // dd($users[0]->entreprise);
        return view('admin.role_permission.users.create', compact('entreprises', 'roles', 'permissions'));
    }

    /*------------------------------------------- End Users Routes ---------------------------------------------- */

    /*--------------------------------------------- Roles Routes ------------------------------------------------ */
    public function rolesIndex()
    {
        $roles = Role::all();
        return view('admin.role_permission.roles.index', compact('roles'));
    }
    
    public function rolesStore(Request $request)
    {
        if($request->name && $request->name != ''){
            $role = Role::create([
                'name' => $request->name
            ]);
        }
        return back();
    }
    
    /*------------------------------------------- End Roles Routes ---------------------------------------------- */
    
    /*------------------------------------------ Permissions Routes --------------------------------------------- */
    public function permissionsIndex()
    {
        $permissions = Permission::all();
        return view('admin.role_permission.permissions.index', compact('permissions'));
    }
    
    public function permissionsStore(Request $request)
    {
        if($request->name && $request->name != ''){
            $permission = Permission::create([
                'name' => $request->name
            ]);
        }
        return back();
    }
    /*---------------------------------------- End Permissions Routes ------------------------------------------- */
    
    /*------------------------------------------ Entrepots Routes --------------------------------------------- */
    public function entrepotsIndex()
    {
        $entrepots = Entrepot::all();
        return view('admin.entrepots.index', compact('entrepots'));
    }
    
    public function entrepotsStore(Request $request)
    {
        if($request->name && $request->name != ''){
            $entrepot = Entrepot::create([
                'name' => $request->name
            ]);
        }
        return back();
    }
    /*---------------------------------------- End Entrepots Routes ------------------------------------------- */

    /*------------------------------------------ Categories Routes --------------------------------------------- */
    public function categoriesIndex()
    {
        $categories = Category::mothers();
        return view('admin.categories.index', compact('categories'));
    }
    
    public function categoriesStore(Request $request)
    {
        if($request->name && $request->name != ''){
            $category = Category::create([
                'name' => $request->name,
                // 'id_categories' => 1
            ]);
        }
        return back();
    }
    /*---------------------------------------- End Categories Routes ------------------------------------------- */

}
