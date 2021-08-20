<?php

namespace App\Http\Controllers\Stock;

use App\Http\Controllers\Controller;
use App\Models\Fournisseur;
use App\Models\TypeFournisseur;
use Illuminate\Http\Request;

class FournisseurController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $fournisseurs = Fournisseur::where('status', 1)->orderBy('nom', 'asc')->get();

        return view('main.fournisseur.index',compact('fournisseurs'));
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
            "nom" => "required|min:3",
            "slug_type_fournisseur" => "required",
            "contact" => "required",
            "email" => "required|email"

        ], [
            "nom.required" => "Le nom est un champ est requis !",
            "slug_type_fournisseur.required" => "Le type de fournisseur est un champ est requis !",
            "contact.required" => "Le contact est un champ requis !",
            "email.required" => "L'email est un champ requis !",
            "email.email" => "L'email entrée est invalide !"
        ]);

        $typefournisseur = TypeFournisseur::where('slug', $request->slug_type_fournisseur)->first();

        $fournisseur = Fournisseur::create($validatedData);
        $fournisseur->id_type_fournisseur   = $typefournisseur->id;
        $fournisseur->codefour = "F". $fournisseur->id;
        $fournisseur->save();

        $notification = array(
            "message" => "Le nouveau fournisseur à été ajouté !",
            "alert-type" => "success"
        );
        
        return redirect()->back()->with($notification);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Fournisseur  $fournisseur
     * @return \Illuminate\Http\Response
     */
    public function show(Fournisseur $fournisseur)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Fournisseur  $fournisseur
     * @return \Illuminate\Http\Response
     */
    public function edit(Fournisseur $fournisseur)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Fournisseur  $fournisseur
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $slug)
    {
        //
        $validatedData = $request->validate([
            "nom" => "required|min:3",
            "slug_type_fournisseur" => "required",
            "contact" => "required",
            "email" => "required|email"

        ], [
            "nom.required" => "Le nom est un champ est requis !",
            "slug_type_fournisseur.required" => "Le type de fournisseur est un champ est requis !",
            "contact.required" => "Le contact est un champ requis !",
            "email.required" => "L'email est un champ requis !",
            "email.email" => "L'email entrée est invalide !"
        ]);
        //dd($slug);
        $typefournisseur = TypeFournisseur::where('slug', $request->slug_type_fournisseur)->first();
        $fournisseur = Fournisseur::where('slug', $slug)->first();
       
        $fournisseur->update($validatedData);
        $fournisseur->id_type_fournisseur   = $typefournisseur->id;
        $fournisseur->codefour = "F". $fournisseur->id;
        $fournisseur->save();

        $notification = array(
            "message" => "Le nouveau fournisseur à été ajouté !",
            "alert-type" => "success"
        );
        
        return redirect()->back()->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Fournisseur  $fournisseur
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        //
        //dd($slug);
        $fournisseur = Fournisseur::where('slug', $slug)->first();
        $fournisseur->status = 0;
        $fournisseur->save();
        $notification = array(
            "message" => "Vous avez supprimer un fournisseur de cette liste | ".$fournisseur->nom." !",
            "alert-type" => "success"
        );
        
        return redirect()->back()->with($notification);
    }
}
