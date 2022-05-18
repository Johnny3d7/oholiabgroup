<?php

namespace App\Http\Controllers\Achat;

use App\Http\Controllers\Controller;
use App\Models\Besoin;
use App\Models\Entreprise;
use App\Models\LigneBesoin;
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
        $besoins = Besoin::all();
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
        
        $date_emission = $request->date_emission;
        $date_livraison = $request->date_livraison
        ;
        // $date = explode('-',$request->date_emission);
        // dd($request->date_emission);
        
        //Voir si le format de la date est respecté
        $error_msg = [];

        if (!strtotime($date_emission)) // if (!strtotime($date[2].'-'.$date[1].'-'.$date[0]))
            $error_msg[] = "La date d'émission est incorrecte. Veuillez réessayer svp!";
        if (strtotime($date_emission) > strtotime("today")) // if (strtotime($date[2].'-'.$date[1].'-'.$date[0]) > strtotime("today"))
            $error_msg[] = "La date d'émission doit être inférieure ou égale à la date d'aujourd'hui. Veuillez réessayer svp!";

        if (!strtotime($date_livraison)) // if (!strtotime($date[2].'-'.$date[1].'-'.$date[0]))
            $error_msg[] = "La date d'émission est incorrecte. Veuillez réessayer svp!";
        if (strtotime($date_livraison) < strtotime($date_emission)) // if (strtotime($date[2].'-'.$date[1].'-'.$date[0]) > strtotime("today"))
            $error_msg[] = "La date d'émission doit être inférieure ou égale à la date d'émission. Veuillez réessayer svp!";

        if($error_msg && is_array($error_msg) && count($error_msg)>0){
            $notification = array(
                "message" => implode(";", $error_msg),
                "alert-type" => "error"
            );
            return redirect()->back()->with($notification);
        }

        $request->merge([
            'statut' => "En attente",
        ]);
        $besoin = Besoin::create($request->all());
        // $besoin = Besoin::first();

        $key = 1; $exist = true;
        do {
            if(isset($request->{"article_$key"})) $key++;
            else $exist = false;
        } while($exist);
        
        for ($i=1; $i < $key; $i++) {
            LigneBesoin::create([
                'article' => $request->{"article_$i"},
                'quantite' => $request->{"quantite_$i"},
                'prix' => $request->{"prix_$i"},
                'observations' => $request->{"observations_$i"},
                'id_besoins' => $besoin->id
            ]);
        }

        $notification = array(
            "message" => "Le bon d'expression de besoin a bien été enregistré !",
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
