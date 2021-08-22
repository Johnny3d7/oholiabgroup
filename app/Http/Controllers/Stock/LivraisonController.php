<?php

namespace App\Http\Controllers\Stock;

use App\Http\Controllers\Controller;
use App\Models\Commande;
use App\Models\Livraison;
use Illuminate\Http\Request;

class LivraisonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $livraisons = Livraison::orderBy('created_at', 'desc')->get();

        return view('main.livraison.index',compact('livraisons'));
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

    public function creer_bonlivraison(Request $request)
    {
        $commande = Commande::find($request->commande_id);
        //dd($request);
        $validatedData = $request->validate([
            "nom_livreur" => "required|min:3",
            "commande_id" => "required"
        ], [
            "nom_livreur.required" => "Le nom du livreur est un champs requis",
            "commande_id.required" => "Le numero de la commande est un champs requis"
        ]);

        $livraison = new Livraison();;
        $livraison->nom_livreur = $request->nom_livreur;
        if ($request->has('numero_vehicule')) {

            $livraison->numero_vehicule = $request->numero_vehicule;
        }
        $livraison->id_commande = $request->commande_id;

        $livraison->save();

        $commande->create_bonlivraison = 1;
        $commande->save();

        $notification = array(
            "message" => "Vous avez crée un bon de livraison pour cette commande!",
            "alert-type" => "success"
        );
        
        return redirect()->back()->with($notification);
    }
}
