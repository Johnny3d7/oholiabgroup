<?php

namespace App\Http\Controllers\Stock;

use App\Http\Controllers\Controller;
use App\Models\Entreprise;
use Illuminate\Http\Request;

class EntrepriseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $entreprises = Entreprise::where('status', 1)->orderBy('nom', 'asc')->get();

        return view('main.stock.entreprise.index',compact('entreprises'));
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
            "adresse" => "required",
            "email" => "required|email",
            "contact" => "required"

        ], [
            "nom.required" => "Le nom est un champ est requis !",
            "adresse.required" => "L'adresse de l'entreprise est un champ est requis !",
            "contact.required" => "Le contact est un champ requis !",
            "email.required" => "L'email est un champ requis !",
            "email.email" => "L'email entrée est invalide !"
        ]);

        //$typefournisseur = TypeFournisseur::where('slug', $request->slug_type_fournisseur)->first();

        $entreprise = Entreprise::create($validatedData);
        $entreprise->save();

        $notification = array(
            "message" => "Une nouvelle entreprise a été ajouté !",
            "alert-type" => "success"
        );
        
        return redirect()->back()->with($notification);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Entreprise  $entreprise
     * @return \Illuminate\Http\Response
     */
    public function show(Entreprise $entreprise)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Entreprise  $entreprise
     * @return \Illuminate\Http\Response
     */
    public function edit(Entreprise $entreprise)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Entreprise  $entreprise
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $slug)
    {
        //
        $validatedData = $request->validate([
            "nom" => "required|min:3",
            "adresse" => "required",
            "email" => "required|email",
            "contact" => "required|email"

        ], [
            "nom.required" => "Le nom est un champ est requis !",
            "adresse.required" => "L'adresse de l'entreprise est un champ est requis !",
            "contact.required" => "Le contact est un champ requis !",
            "email.required" => "L'email est un champ requis !",
            "email.email" => "L'email entrée est invalide !"
        ]);

        //$typefournisseur = TypeFournisseur::where('slug', $request->slug_type_fournisseur)->first();
        $entreprise = Entreprise::where('slug', $slug)->first();
        $entreprise->update($validatedData);
        $entreprise->save();

        $notification = array(
            "message" => "L'entreprise a été modifié avec succès !",
            "alert-type" => "success"
        );
        
        return redirect()->back()->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Entreprise  $entreprise
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        //
        $entreprise = Entreprise::where('slug', $slug)->first();
        $entreprise->status = 0;
        $entreprise->save();
        $notification = array(
            "message" => "Vous avez supprimer une entreprise de cette liste!",
            "alert-type" => "success"
        );
        
        return redirect()->back()->with($notification);
    }
}
