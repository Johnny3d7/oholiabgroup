<?php

namespace App\Http\Controllers\Achat;

use App\Http\Controllers\Controller;
use App\Models\Besoin;
use App\Models\Facture;
use App\Models\Fournisseur;
use App\Models\LigneBesoin;
use App\Models\LigneFacture;
use Illuminate\Http\Request;
use stdClass;

class LigneController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lignes = LigneFacture::all();
        return view('main.achats.lignes.index', compact('lignes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $ligne = $request->ligne ? LigneBesoin::whereUuid($request->ligne)->first() : null;
        $factures = Facture::all();
        return view('main.achats.lignes.create', compact('ligne', 'factures'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $key = 1; $exist = true;
        do {
            if(isset($request->{"id_ligne_besoins_$key"})) $key++;
            else $exist = false;
        } while($exist);

        for ($i=1; $i < $key; $i++) {
            $ligne = LigneBesoin::find($request->{"id_ligne_besoins_$i"});
            $facture = Facture::find($request->{"id_factures_$i"});
            if($ligne && $facture){
                LigneFacture::create([
                    'id_ligne_besoins' => $ligne->id,
                    'id_factures' => $facture->id,
                    'observations' => $request->{"observations_$i"},
                ]);

                $ligne->update(['statut' => 'acheté']);
            }
        }

        $notification = array(
            "message" => "Enregistrement effectué avec succès !",
            "alert-type" => "success"
        );
        return back()->with($notification);
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
}
