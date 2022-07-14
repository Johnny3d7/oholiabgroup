<?php

namespace App\Http\Controllers\Achat;

use App\Http\Controllers\Controller;
use App\Models\Facture;
use App\Models\Entreprise;
use App\Models\Fournisseur;
use App\Models\LigneFacture;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Models\Role;

class FactureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $factures = Facture::all();
        return view('main.achats.factures.index', compact('factures'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $fournisseurs = Fournisseur::all();
        return view('main.achats.factures.create', compact('fournisseurs'));
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
            "id_fournisseurs" => "required|exists:fournisseurs,id",
            "reference" => "required",
            "montant" => "required",
            "date_emission" => "required|date"
        ]);
        $facture = Facture::create($request->all());

        if ($file = $request->file('file')) {
            $name = $facture->reference;
            $fileName = str_replace(' ', '_', $name) . '_' . time() . '.' . $file->extension();
            $path = $file->storeAs('Factures', $fileName, 'public');
            $facture->file = 'storage/' . $path;
            $facture->save();
        }

        $notification = array(
            "message" => "La facture a bien été enregistrée !",
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
    public function show(Facture $facture)
    {
        return view("main.achats.factures.show", compact('facture'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Facture $facture)
    {
        $entreprises = Entreprise::all();
        return view('main.achats.factures.edit', compact('entreprises', 'facture'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Facture $facture)
    {
        $notification = array(
            "message" => "Le bon d'expression de facture a bien été modfié et retransmis !",
            "alert-type" => "success"
        );
        return redirect()->route('achats.factures.show', $facture)->with($notification);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateLigne(Request $request, LigneFacture $ligne)
    {
        $notification = array(
            "message" => "Ligne de bon d'expression de facture a bien été modfiée et retransmis !",
            "alert-type" => "success"
        );
        return back()->with($notification);
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

    /**
     * Validation of the specified resource
     *
     * @param \Illuminate\Http\Request $request
     * @param Facture $facture
     * @return \Illuminate\Http\Response
     */
    public function validation(Request $request, Facture $facture)
    {
        $notification = array(
            "message" => "Le bon d'expression de facture a été avec succès !",
            "alert-type" => "success"
        );
        return redirect()->back()->with($notification);

    }
}
