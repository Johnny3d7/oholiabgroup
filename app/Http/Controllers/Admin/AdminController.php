<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Entrepot;
use App\Models\Entreprise;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
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
        return view('admin.fontawesome');
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

    public function usersStore(Request $request)
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
        // dd(session('routeStack'));
        $permissions = Permission::all();
        return view('admin.role_permission.permissions.index', compact('permissions'));
    }
    
    public function permissionsStore(Request $request)
    {
        if($request->name && $request->name != ''){
            $permission = Permission::create([
                'name' => $request->name,
                'display_name' => $request->display_name,
                'table' => $request->table,
            ]);
        }
        return back();
    }
    /*---------------------------------------- End Permissions Routes ------------------------------------------- */

    /*--------------------------------------------- Entreprises Routes ------------------------------------------------ */
    public function entreprisesIndex()
    {
        $entreprises = Entreprise::all();
        return view('admin.entreprises.index', compact('entreprises'));
    }
    
    public function entreprisesStore(Request $request)
    {
        if($request->name && $request->name != ''){
            $entreprise = Entreprise::create([
                'name' => $request->name
            ]);
        }
        return back();
    }
    
    /*------------------------------------------- End Entreprises Routes ---------------------------------------------- */
    
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

    /*------------------------------------------ Entrepots Routes --------------------------------------------- */
    public function productsIndex()
    {
        $products = Product::all();
        return view('admin.products.index', compact('products'));
    }
    
    public function productsStore(Request $request)
    {
        if($request->name && $request->name != ''){
            $product = Entrepot::create([
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
