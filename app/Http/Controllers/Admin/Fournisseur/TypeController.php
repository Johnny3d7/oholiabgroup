<?php

namespace App\Http\Controllers\Admin\Fournisseur;

use App\Http\Controllers\Controller;
use App\Models\Parametre;
use Illuminate\Http\Request;

class TypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // dd(session('routeStack'));
        $parametres = Parametre::f_types();
        $type = 'type';
        $model = 'fournisseurs.';
        return view('admin.parametres.index', compact('parametres', 'type', 'model'));
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
        if($request->name && $request->name != ''){
            $type = Parametre::create([
                'name' => $request->name,
                'type' => 'type'
            ]);

            $notification = array(
                "message" => "Type ajouté avec succès !",
                "alert-type" => "success"
            );

            return redirect()->back()->with($notification);
        }
        return back();
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
    public function update(Request $request, Parametre $type)
    {
        if($request->name && $request->name != ''){
            $type->update([
                'name' => $request->name,
            ]);

            $notification = array(
                "message" => "Type renommé avec succès !",
                "alert-type" => "success"
            );

            return redirect()->back()->with($notification);
        }
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Parametre $type)
    {
        $type->delete();

        $notification = array(
            "message" => "Type supprimé avec succès !",
            "alert-type" => "success"
        );

        return redirect()->back()->with($notification);
    }
}
