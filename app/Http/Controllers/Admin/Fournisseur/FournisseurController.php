<?php

namespace App\Http\Controllers\Admin\Fournisseur;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Entreprise;
use App\Models\Fournisseur;
use App\Models\Parametre;
use Illuminate\Database\Eloquent\Collection;
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
        $fournisseurs = Fournisseur::all();
        return view('admin.fournisseurs.index', compact('fournisseurs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $types = Parametre::f_types();
        $entreprises = Entreprise::all();
        return view('admin.fournisseurs.create', compact('types', 'entreprises'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            "name" => "required|min:2",
            "contact" => "required",
            "email" => "required|email",
            "type" => "required",

        ], [
            "name.required" => "Le nom est un champ est requis",
            "name.min" => "Le nom doit comporter au moins 02 caractères",
            "contact.required" => "Le contact est un champ requis",
            "email.required" => "L'email est un champ requis",
            "email.email" => "L'email est incorrect",
            "type.required" => "Le type est un champ requis",
        ]);

        $fournisseur = Fournisseur::create($request->all());

        if ($image = $request->file('image')) {
            $name = $request->name;
            $fileName = str_replace(' ', '_', $name) . '_' . time() . '.' . $image->extension();
            $path = $image->storeAs('Fournisseurs', $fileName, 'public');
            $fournisseur->image = 'storage/' . $path;
            $fournisseur->save();
        }

        $notification = array(
            "message" => "Votre nouveau fournisseur est ajouté avec succès !",
            "alert-type" => "success"
        );

        return redirect()->back()->with($notification);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Fournisseur $fournisseur)
    {
        return view('admin.fournisseurs.show',compact('fournisseur'));
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
}
