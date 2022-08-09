<?php

namespace App\Http\Controllers\Stock;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Client;
use App\Models\Entrepot;
use App\Models\Entreprise;
use App\Models\Fournisseur;
use App\Models\Inventaire;
use App\Models\InventaireCategory;
use App\Models\LigneInventaire;
use App\Models\Notification;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class InventaireController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $inventaires = Inventaire::all();
        return view('main.stock.inventaires.index',compact('inventaires'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $entrepots = Entrepot::all();
        return view('main.stock.inventaires.create', compact('entrepots'));
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
            "name" => "required|min:2",
            "date_inventaire" => "required",
        ], [
            "name.required" => "Le titre est un champ est requis",
            "date_inventaire.required" => "La date de l'inventaire est un champ requis",
        ]);

        $request->merge(['statut' => config('constants.statut.inventaires.attente')]);
        $inventaire = Inventaire::create($request->all());

        $notification = array(
            "message" => "Votre nouvel inventaire est ajouté avec succès !",
            "alert-type" => "success"
        );
        if($request->procede) return redirect()->route('stock.inventaires.procede', $inventaire);
        return redirect()->back()->with($notification);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Inventaire  $inventaire
     * @return \Illuminate\Http\Response
     */
    public function show(Inventaire $inventaire)
    {
        return view('main.stock.inventaires.show',compact('inventaire'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Inventaire  $inventaire
     * @return \Illuminate\Http\Response
     */
    public function procede(Inventaire $inventaire)
    {
        // dd($inventaire);
        return view('main.stock.inventaires.create_ligne',compact('inventaire'));
    }

    public function procedePost(Request $request, Inventaire $inventaire)
    {
        $key = 0; $exist = true;
        while ($exist) {
            $key++;
            if(!isset($request->{"id_products_$key"})) $exist = false;
        }
        // $key--;

        for ($i=1; $i < $key; $i++) {
            $product = Product::find($request->{"id_products_$i"});
            if($product){
                LigneInventaire::create([
                    'qte_att' => $inventaire->entrepot->ehp($product)->quantite,
                    'qte_res' => $request->{"qte_res_$i"},
                    'statut' => $request->{"statut_$i"},
                    'observations' => $request->{"observations_$i"},
                    'id_products' => $product->id,
                    'id_inventaires' => $inventaire->id
                ]);
            } else {
                dd('error', $key, $request->all(), $key);
            }
        }

        $entreprise = Entreprise::find($request->id_entreprises);
        $roles = Role::whereName('Comptable')->orWhere('name', 'Chef comptable')->get();
        foreach ($roles as $role) {
            $users = $role->users;
            foreach ($users as $user) {
                Notification::create([
                    'id_users' => $user->id,
                    'title' => "Nouvel inventaire effectué en attente de validation",
                    'body' => 'Inventaire de '. $inventaire->entrepot->name . ' le ' . date_format(new \DateTime($inventaire->date_inventaire), 'd/m/Y'),
                    'link' => route('stock.inventaires.show', $inventaire),
                ]);
            }
        }

        $inventaire->update(['statut' => config('constants.statut.inventaires.validation')]);

        $notification = array(
            "message" => "Inventaire effectué avec succès !",
            "alert-type" => "success"
        );
        return redirect()->route('stock.inventaires.show', $inventaire)->with($notification);
    }

    /**
     * Validation of the specified resource
     *
     * @param \Illuminate\Http\Request $request
     * @param Inventaire $inventaire
     * @return \Illuminate\Http\Response
     */
    public function validation(Request $request, Inventaire $inventaire)
    {
        $validatedData = $request->validate(["statut" => "required"], ["statut.required" => "Erreur de validation liée au statut"]);

        $statut = $request->statut == 'valide' ? "validé" : ($request->statut == 'annulé' ? 'annulé' : 'refusé');
        $motif = $request->motif;
        if($statut == 'refusé' && !$motif){
            $msg = "Merci de renseigner le motif de refus !";
            $notification = array(
                "message" => $msg,
                "alert-type" => "error"
            );
            if($request->api) return response()->json(["error"=>$msg], 400);
            return redirect()->back()->with($notification);
        }

        $actions = [
            config('constants.roles.geststock') => 'vs_inventoriste',
            config('constants.roles.comptable') => 'vs_comptable',
            config('constants.roles.chefcomptable') => 'vs_chef_comptable',
        ];

        $inventaire->update([
            $actions[\Auth::user()->role->name] => $statut == 'validé' ?? 2
        ]);

        if(!in_array(0, [$inventaire->{$actions[config('constants.roles.geststock')]}, $inventaire->{$actions[config('constants.roles.comptable')]}, $inventaire->{$actions[config('constants.roles.chefcomptable')]}]))
            $inventaire->update(['statut' => config('constants.statut.inventaires.valide')]);

        foreach ($actions as $name => $value) {
            $users = [];
            if(Role::whereName($name)->first()) $users = Role::whereName($name)->first()->users;

            foreach ($users as $user) {
                Notification::create([
                    'id_users' => $user->id,
                    'title' => "Validation d'inventaire par un " . \Auth::user()->role->name,
                    'body' => "L'inventaire du " . date_format(new \DateTime($inventaire->date_inventaire), 'd/M/Y') . " a été $statut par ". \Auth::user()->employe->name() . " - " . $inventaire->entrepot->entreprise->name,
                    'link' => route('stock.inventaires.show', $inventaire),
                    'type' => $statut == 'validé' ? 'success' : 'danger',
                ]);
            }
        }

        $msg = "L'inventaire a été $statut avec succès !";
        $notification = array(
            "message" => $msg,
            "alert-type" => "success"
        );
        if($request->api) return response()->json(["msg"=>$msg], 200);
        return redirect()->back()->with($notification);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Inventaire  $inventaire
     * @return \Illuminate\Http\Response
     */
    public function edit(Inventaire $inventaire)
    {
        return view('main.stock.inventaires.edit',compact('inventaire'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Inventaire  $inventaire
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Inventaire $inventaire)
    {
        //

        $inventaire->save();

        $notification = array(
            "message" => "Le produit à été modifié avec succès!",
            "alert-type" => "success"
        );

        return redirect()->back()->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Inventaire  $inventaire
     * @return \Illuminate\Http\Response
     */
    public function destroy(Inventaire $inventaire)
    {
        //
        $inventaire->save();
        $notification = array(
            "message" => "Vous avez supprimer un produit de cette liste!",
            "alert-type" => "success"
        );

        return redirect()->route('stock.inventairess.index')->with($notification);
    }
}
