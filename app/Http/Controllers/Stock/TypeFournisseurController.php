<?php

namespace App\Http\Controllers\Stock;

use App\Http\Controllers\Controller;
use App\Models\TypeFournisseur;
use Illuminate\Http\Request;

class TypeFournisseurController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $types = TypeFournisseur::where('status', 1)->orderBy('lib', 'asc')->get();

        return view('main.stock.type_fournisseur.index',compact('types'));
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
        $validatedData = $request->validate([
            "lib" => "required|min:3"
        ], [
            "lib.required" => "Le libellé est un champ est requis",
        ]);

        $type = TypeFournisseur::create($validatedData);
        
        $notification = array(
            "message" => "Type ajouter avec succès!",
            "alert-type" => "success"
        );
        
        return redirect()->back()->with($notification);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TypeFournisseur  $typeFournisseur
     * @return \Illuminate\Http\Response
     */
    public function show(TypeFournisseur $typeFournisseur)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TypeFournisseur  $typeFournisseur
     * @return \Illuminate\Http\Response
     */
    public function edit(TypeFournisseur $typeFournisseur)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TypeFournisseur  $typeFournisseur
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $slug)
    {
        //
        $validatedData = $request->validate([
            "lib" => "required|min:3",
        ], [
            "lib.required" => "Le libellé est un champ est requis",
        ]);
        $type = TypeFournisseur::where('slug', $slug)->first();
        $type->update($validatedData);
           
        $notification = array(
            "message" => "Type fournisseur modifié avec succès!",
            "alert-type" => "success"
        );
        
        return redirect()->back()->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TypeFournisseur  $typeFournisseur
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        //
        $type = TypeFournisseur::where('slug', $slug)->first();
        $type->status = 0;
        $type->save();
        $notification = array(
            "message" => "Vous avez supprimer un type fournisseur!",
            "alert-type" => "success"
        );
        
        return redirect()->back()->with($notification);
    }
}
