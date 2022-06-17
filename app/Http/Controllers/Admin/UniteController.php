<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Parametre;
use Illuminate\Http\Request;

class UniteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // dd(session('routeStack'));
        $parametres = Parametre::unites();
        $type = 'unite';
        return view('admin.products.parametres.index', compact('parametres', 'type'));
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
            $unite = Parametre::create([
                'name' => $request->name,
                'type' => 'unite'
            ]);

            $notification = array(
                "message" => "Unité ajoutée avec succès !",
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
    public function update(Request $request, Parametre $unite)
    {
        if($request->name && $request->name != ''){
            $unite->update([
                'name' => $request->name,
            ]);

            $notification = array(
                "message" => "Unité renommée avec succès !",
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
    public function destroy(Parametre $unite)
    {
        $unite->delete();

        $notification = array(
            "message" => "Type supprimé avec succès !",
            "alert-type" => "success"
        );

        return redirect()->back()->with($notification);
    }
}
