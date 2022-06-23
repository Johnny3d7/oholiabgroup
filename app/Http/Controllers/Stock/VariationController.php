<?php

namespace App\Http\Controllers\Stock;

use App\Http\Controllers\Controller;
use App\Models\EntrepotsHasProduct;
use App\Models\LigneMouvement;
use App\Models\Mouvement;
use App\Models\Variation;
use Illuminate\Http\Request;

class VariationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        // dd($request->typemouv);
        $validatedData = $request->validate([
            "typemouv" => "required",
            "qte" => "required|integer",
            "datemouv"=>"required",
            "observation" => "required"
        ]);
        $date = explode('-',$request->datemouv);

        //Voir si le format de la date est respecté
        if (strtotime($date[2].'-'.$date[1].'-'.$date[0]) == false) {
           
            //dd('bonjour');
            $notification = array(
                "message" => "La date du mouvement est incorrecte. Veuillez réessayer svp!",
                "alert-type" => "error"
            );
            
            return redirect()->back()->with($notification);

        }

        if (strtotime($date[2].'-'.$date[1].'-'.$date[0]) > strtotime("today")) {
           
            $notification = array(
                "message" => "La date du mouvement doit être inférieure ou égale à la date d'aujourd'hui. Veuillez réessayer svp!",
                "alert-type" => "error"
            );
            
            return redirect()->back()->with($notification);

        }


        ///(time()-(60*60*24)) < strtotime($var);

        $variation = [
            'type' => $request->typemouv,
            'id_entrepots' => $request->id_entrepots,
            'date_mouvement'=> $date[2].'-'.$date[1].'-'.$date[0],
            'observation' => $request->observation,
            // 'production' => 0,
        ];
        
        // dd($variation);

        $created = null;
        $created = $created ?? Mouvement::create($variation)->id;
        $ligne = LigneMouvement::create([
            'id_products' => $request->id_products,
            'id_mouvements' => $created,
            'quantite' => $request->qte,
        ]);

        if ($request->typemouv == 'in') {
            $ehp = EntrepotsHasProduct::whereIdProducts($request->id_products)->whereIdEntrepots($request->id_entrepots)->first();
            $ehp->update([
                'quantite' => $ehp->quantite + $ligne->quantite,
            ]);
        }
        if ($request->typemouv == 'out') {
            $ehp = EntrepotsHasProduct::whereIdProducts($request->id_products)->whereIdEntrepots($request->id_entrepots)->first();
            $ehp->update([
                'quantite' => $ehp->quantite - $ligne->quantite,
            ]);
        }

        if ($request->typemouv == 'trans') {
            $ehp = EntrepotsHasProduct::whereIdProducts($request->id_products)->whereIdEntrepots($request->id_entrepot_destination)->first();
            $ehp->update([
                'quantite' => $ehp->quantite + $ligne->quantite,
            ]);

            $ehp = EntrepotsHasProduct::whereIdProducts($request->id_products)->whereIdEntrepots($request->id_entrepot_source)->first();
            $ehp->update([
                'quantite' => $ehp->quantite - $ligne->quantite,
            ]);
        }

        $notification = array(
            "message" => "Mouvement ajouté avec succès!",
            "alert-type" => "success"
        );
        
        return redirect()->back()->with($notification);
    }

    /**
     * Transfert de stock d'un entrepot à l'autre
     */
    public function transfert(Request $request)
    {
        //  
        $validatedData = $request->validate([
            "qte" => "required|integer",
            "datemouv"=>"required",
        ]);
        dd($request->typemouv);
        $date = explode('-',$request->datemouv);

        //Voir si le format de la date est respecté
        if (strtotime($date[2].'-'.$date[1].'-'.$date[0]) == false) {
           
            //dd('bonjour');
            $notification = array(
                "message" => "La date du mouvement est incorrecte. Veuillez réessayer svp!",
                "alert-type" => "error"
            );
            
            return redirect()->back()->with($notification);

        }

        if (strtotime($date[2].'-'.$date[1].'-'.$date[0]) > strtotime("today")) {
           
            $notification = array(
                "message" => "La date du mouvement doit être inférieure ou égale à la date d'aujourd'hui. Veuillez réessayer svp!",
                "alert-type" => "error"
            );
            
            return redirect()->back()->with($notification);

        }


        ///(time()-(60*60*24)) < strtotime($var);

        $ypemouv = 0;

        $variation = [
            'typemouv' => $ypemouv,
            'id_entrepot' => $request->id_entrepot_source,
            'id_product' => $request->product,
            'production' => 0,
            'datemouv'=> $date[2].'-'.$date[1].'-'.$date[0],
            'observation' => $request->observation
        ];

        $variation = $variation +[
            'qte_entree' => 0,
            'qte_sortie' => $request->qte,
        ];
    
        $variation = Variation::create($variation);

        $ypemouv = 1;

        $variation2 = [
            'typemouv' => $ypemouv,
            'id_entrepot' => $request->id_entrepot_destination,
            'id_product' => $request->product,
            'production' => 0,
            'datemouv'=> $date[2].'-'.$date[1].'-'.$date[0],
            'observation' => $request->observation
        ];

        $variation2 = $variation2 +[
            'qte_entree' => $request->qte,
            'qte_sortie' => 0,
        ];
        
        $variation2 = Variation::create($variation2);
        
        $notification = array(
            "message" => "Mouvement ajouté avec succès!",
            "alert-type" => "success"
        );
        
        return redirect()->back()->with($notification);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Variation  $variation
     * @return \Illuminate\Http\Response
     */
    public function show(Variation $variation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Variation  $variation
     * @return \Illuminate\Http\Response
     */
    public function edit(Variation $variation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Variation  $variation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $mouvement = Variation::find($id);

        $validatedData = $request->validate([
            "typemouv" => "required|integer",
            "qte" => "required|integer",
            "datemouv"=>"required",
            "observation" => "required"
        ]);

        $date = explode('-',$request->datemouv);

        //Voir si le format de la date est respecté
        if (strtotime($date[2].'-'.$date[1].'-'.$date[0]) == false) {
           
            //dd('bonjour');
            $notification = array(
                "message" => "La date du mouvement est incorrecte. Veuillez réessayer svp!",
                "alert-type" => "error"
            );
            
            return redirect()->back()->with($notification);

        }

        if (strtotime($date[2].'-'.$date[1].'-'.$date[0]) > strtotime("today")) {
           
            $notification = array(
                "message" => "La date du mouvement doit être inférieure ou égale à la date d'aujourd'hui. Veuillez réessayer svp!",
                "alert-type" => "error"
            );
            
            return redirect()->back()->with($notification);

        }


        ///(time()-(60*60*24)) < strtotime($var);

        $variation = [
            'typemouv' => $request->typemouv,
            'id_entreprise' => $mouvement->id_entreprise,
            'id_product' => $mouvement->id_product,
            'production' => 0,
            'datemouv'=> $date[2].'-'.$date[1].'-'.$date[0],
            'observation' => $request->observation
        ];

        if ($request->typemouv == 1) {
            $variation = $variation +[
                'qte_entree' => $request->qte,
                'qte_sortie' => 0,
            ];
        } else {
            $variation = $variation +[
                'qte_entree' => 0,
                'qte_sortie' => $request->qte,
            ];
        }
        
        $variation = $mouvement->update($variation);
        
        $notification = array(
            "message" => "Mouvement modifié avec succès!",
            "alert-type" => "success"
        );
        
        return redirect()->back()->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Variation  $variation
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $variation = Variation::find($id);
        $variation->status = 0;
        $variation->save();
        $notification = array(
            "message" => "Vous avez supprimer un mouvement de cette liste!",
            "alert-type" => "success"
        );
        
        return redirect()->back()->with($notification);
    }
}
