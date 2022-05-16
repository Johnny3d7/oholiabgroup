<?php

namespace App\Http\Controllers\Achat;

use App\Http\Controllers\Controller;
use App\Models\Entreprise;
use Illuminate\Http\Request;

class BesoinController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $besoins = [];
        return view('main.achats.besoins.index', compact('besoins'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $entreprises = Entreprise::all();
        return view('main.achats.besoins.create', compact('entreprises'));
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
            "id_entreprises" => "required|exists:entreprises,id",
            "employe" => "required",
            "date_emission" => "required"
        ]);
        
        $date = explode('-',$request->date_emission);
        // dd($request->all());
        
        //Voir si le format de la date est respecté
        $error_msg = null;
        if (!strtotime($date[2].'-'.$date[1].'-'.$date[0]))
            $error_msg = "La date du mouvement est incorrecte. Veuillez réessayer svp!";
        if (strtotime($date[2].'-'.$date[1].'-'.$date[0]) > strtotime("today"))
            $error_msg = "La date du mouvement doit être inférieure ou égale à la date d'aujourd'hui. Veuillez réessayer svp!";

        if($error_msg){
            $notification = array(
                "message" => $error_msg,
                "alert-type" => "error"
            );
            return redirect()->back()->with($notification);
        }

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
