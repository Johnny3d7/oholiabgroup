<?php

namespace App\Http\Controllers\Achat;

use App\Http\Controllers\Controller;
use App\Models\Besoin;
use App\Models\Fournisseur;
use Illuminate\Http\Request;
use stdClass;

class AchatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $nbre = new stdClass();

        $array = ['validé' => 'valide', 'refusé' => 'refuse','annulé' => 'annule' , 'en attente' => 'attente'];
        foreach ($array as $key => $value) {
            $nbre->{$value} = Besoin::whereStatut($key)->count();
        }

        $nbre->fournisseur = Fournisseur::count();

        return view('main.achats.index', compact('nbre'));
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
}
