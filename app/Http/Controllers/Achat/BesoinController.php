<?php

namespace App\Http\Controllers\Achat;

use App\Http\Controllers\Controller;
use App\Models\Besoin;
use App\Models\Entreprise;
use App\Models\LigneBesoin;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class BesoinController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // dd(Role::whereName('Directrice Générale')->first()->users);
        $target = $request->target ?? 'tous';

        if(!in_array($target, ['tous', 'validé', 'refusé', 'en attente'])) $target = 'tous';

        $besoins = Besoin::all();
        if($target != 'tous'){
            $besoins = Besoin::whereStatut($target)->get();
        }
        return view('main.achats.besoins.index', compact('besoins', 'target'));
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
                "message" => implode("; ", $error_msg),
                "alert-type" => "error"
            );
            return redirect()->back()->with($notification);
        }

        $request->merge(['statut' => "en attente"]);
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
                'unite' => $request->{"unite_$i"},
                'observations' => $request->{"observations_$i"},
                'id_besoins' => $besoin->id
            ]);
        }
        $entreprise = Entreprise::find($request->id_entreprises);
        $users = Role::whereName('Directrice Générale')->first()->users;
        foreach ($users as $user) {
            Notification::create([
                'id_users' => $user->id,
                'title' => "Nouveau bon d'expression de besoin",
                'body' => $request->nature . ' - ' . $entreprise->name,
                'link' => route('achats.besoins.show', $besoin),
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
    public function show(Besoin $besoin)
    {
        return view("main.achats.besoins.show", compact('besoin'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Besoin $besoin)
    {
        $entreprises = Entreprise::all();
        return view('main.achats.besoins.edit', compact('entreprises', 'besoin'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Besoin $besoin)
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
                "message" => implode("; ", $error_msg),
                "alert-type" => "error"
            );
            return redirect()->back()->with($notification);
        }

        $request->merge(['statut' => "en attente"]);
        $besoin->update($request->all());

        $key = 1; $exist = true;

        while ($exist) {
            $key++;
            if(!isset($request->{"article_$key"})) $exist = false;
        }

        $lignes = $besoin->lignes;

        if(count($lignes) > $key-1){
            for ($j=0; $j < (count($lignes)-$key+1); $j++) {
                $lignes[$j + $key-1]->delete();
            }
        }

        for ($i=1; $i < $key; $i++) {
            if(isset($lignes[$i-1])) {
                $ligne = $lignes[$i-1];
                $ligne->update([
                    'article' => $request->{"article_$i"},
                    'quantite' => $request->{"quantite_$i"},
                    'prix' => $request->{"prix_$i"},
                    'unite' => $request->{"unite_$i"},
                    'observations' => $request->{"observations_$i"}
                ]);
            } else {
                LigneBesoin::create([
                    'article' => $request->{"article_$i"},
                    'quantite' => $request->{"quantite_$i"},
                    'prix' => $request->{"prix_$i"},
                    'unite' => $request->{"unite_$i"},
                    'observations' => $request->{"observations_$i"},
                    'id_besoins' => $besoin->id
                ]);
            }
        }

        $entreprise = Entreprise::find($request->id_entreprises);
        $users = Role::whereName('Directrice Générale')->first()->users;
        foreach ($users as $user) {
            Notification::create([
                'id_users' => $user->id,
                'title' => "Edition et retransmission de bon d'expression de besoin",
                'body' => $request->nature . ' - ' . $entreprise->name,
                'link' => route('achats.besoins.show', $besoin),
            ]);
        }

        $notification = array(
            "message" => "Le bon d'expression de besoin a bien été modfié et retransmis !",
            "alert-type" => "success"
        );
        return redirect()->route('achats.besoins.show', $besoin)->with($notification);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateLigne(Request $request, LigneBesoin $ligne)
    {
        $validatedData = $request->validate([
            "article" => "required",
            "prix" => "required",
            "quantite" => "required",
            "unite" => "required",
        ]);

        $ligne->update([
            'article' => $request->{"article"},
            'quantite' => $request->{"quantite"},
            'prix' => $request->{"prix"},
            'unite' => $request->{"unite"},
            'observations' => $request->{"observations"}
        ]);

        $notification = array(
            "message" => "Ligne de bon d'expression de besoin a bien été modfiée et retransmis !",
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
     * @param Besoin $besoin
     * @return \Illuminate\Http\Response
     */
    public function validation(Request $request, Besoin $besoin)
    {
        $validatedData = $request->validate(["statut" => "required"], ["statut.required" => "Erreur de validation liée au statut"]);

        // dd($request->all());

        $statut = $request->statut == 'valide' ? "validé" : ($request->statut == 'annulé' ? 'annulé' : 'refusé');
        $motif = $request->motif;
        if($statut == 'refusé' && !$motif){
            $notification = array(
                "message" => "Merci de renseigner le motif de refus !",
                "alert-type" => "error"
            );
            return redirect()->back()->with($notification);
        }

        $besoin->update(compact('statut', 'motif'));

        if($statut == 'annulé') {
            $users = Role::whereName("Chargé d'Achats")->first()->users;
        } else {
            $users = Role::whereName("Directrice Générale")->first()->users;
        }

        $users = [User::find($besoin->created_by)]; // Only the creator of the object will receive the notification

        foreach ($users as $user) {
            Notification::create([
                'id_users' => $user->id,
                'title' => "Bon d'expression de besoin $statut",
                'body' => $besoin->nature . ' - ' . $besoin->entreprise->name,
                'link' => route('achats.besoins.show', $besoin),
                'type' => $statut == 'validé' ? 'success' : 'danger',
            ]);
        }

        $notification = array(
            "message" => "Le bon d'expression de besoin a été $statut avec succès !",
            "alert-type" => "success"
        );
        return redirect()->back()->with($notification);

    }
}
