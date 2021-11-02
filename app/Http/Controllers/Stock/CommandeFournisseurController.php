<?php

namespace App\Http\Controllers\Stock;

use App\Http\Controllers\Controller;
use App\Models\CommandeFournisseur;
use App\Models\Fournisseur;
use App\Models\Livraison;
use DateTime;
use App\Models\Product;
use App\Models\Variation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
class CommandeFournisseurController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $commandes = CommandeFournisseur::whereIn('status', [0,1,2,3,4,5,7,8])->where('id_entreprise',Auth::user()->entreprise->id)->orderBy('created_at', 'desc')->get();
        return view('main.stock.commande_fournisseur.index',compact('commandes'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function commandeRecu()
    {
        if (Auth::user()->entreprise->id == 1) {
            $commandes = CommandeFournisseur::whereIn('status', [1,2,3,4,5,7,8])->where('id_fournisseur',Auth::user()->entreprise->id)->orderBy('created_at', 'desc')->get();
        }else{
            $commandes = CommandeFournisseur::whereIn('status', [1,2,3,4,5,7,8])->where('id_fournisseur',Auth::user()->entreprise->id)->orderBy('created_at', 'desc')->get();
        }
        
        return view('main.stock.commande_fournisseur.recu',compact('commandes'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function view($id)
    {
            
        $commande = CommandeFournisseur::find($id);
        
        return view('main.stock.commande_fournisseur.commandefournisseurview',compact('commande'));
    }

    public function viewlivraison($id)
    {
            
        $commande = CommandeFournisseur::find($id);
        
        return view('main.stock.commande_fournisseur.commandefournisseurviewlivraison',compact('commande'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('main.stock.commande_fournisseur.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $id_entreprise = Auth::user()->entreprise->id;
        if ($id_entreprise == 1) {

            $validatedData = $request->validate([
                "id_fournisseur" => "required|integer",
                "product.*" =>"required",
                "qte.*" =>"required"
            ], [
                "id_fournisseur.required" => "Le nom du fournisseur est un champ est requis",
            ]);

            $commande = CommandeFournisseur::create([
                "id_fournisseur" => $request->id_fournisseur,
                "type_commande" => Fournisseur::find($request->id_fournisseur)->typeFournisseur->id,
                "id_user" => Auth::user()->id,
                "id_entreprise" => Auth::user()->entreprise->id,

            ]);

        } elseif($id_entreprise == 2 || $id_entreprise == 3) {

            $validatedData = $request->validate([
                "product.*" =>"required",
                "qte.*" =>"required"
            ]);

            $commande = CommandeFournisseur::create([
                "id_fournisseur" => 1,
                "type_commande" => Fournisseur::find(1)->typeFournisseur->id,
                "id_user" => Auth::user()->id,
                "id_entreprise" => Auth::user()->entreprise->id,
                
            ]);
        }
        if ($id_entreprise == 1) {
            $commande->update([
                "num_cmd" => "OHOCMD-".((int)(CommandeFournisseur::where('id_entreprise',$id_entreprise)->count()))
            ]);
        } elseif($id_entreprise == 2) {
            $commande->update([
                "num_cmd" => "AKECMD-".((int)(CommandeFournisseur::where('id_entreprise',$id_entreprise)->count()))
            ]);
        }
        elseif($id_entreprise == 3) {
            $commande->update([
                "num_cmd" => "OBPCMD-".((int)(CommandeFournisseur::where('id_entreprise',$id_entreprise)->count()))
            ]);
        }
       
        $tabprod[0] = $request->product[0];
        $tabqte[0] = $request->qte[0];

        for ($i=0; $i < 1 ; $i++) { 

            for ($j=0; $j < sizeof($request->product) ; $j++) {

                if ($i == $j) {
                   
                }else{
                    if (in_array($request->product[$j], $tabprod)) {

                        $position = array_search($request->product[$j], $tabprod);
                        $tabqte[$position]+= $request->qte[$j];

                    }
                    else{

                        $tabprod[sizeof($tabprod)] = $request->product[$j];
                        $tabqte[sizeof($tabprod)-1] = $request->qte[$j];

                    } 
                } 
            }
        }

        $products = DB::table('products')->whereIn('id', $tabprod)->get();
        //dd($tabqte);
        $i = 0;

       foreach ($products as $data) {

            $commande->products()->attach($data->id,  
                [
                    "qte" => $tabqte[$i],
                ]
            );

           $i++;
        }

        $notification = array(
            "message" => "La commande fournisseur à été enregistrée avec succès !",
            "alert-type" => "success"
        );
        
        return redirect()->route('commande_fournisseur.show',['id'=>$commande->id])->with($notification);

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
        $commande = CommandeFournisseur::find($id);
        return view('main.stock.commande_fournisseur.show',compact('commande'));
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
        $commande = CommandeFournisseur::find($id);
        $commande->status = 6;
        $commande->save();

        $notification = array(
            "message" => "Vous avez supprimer une commande forunisseur!",
            "alert-type" => "success"
        );
        
        return redirect()->back()->with($notification);
    }

    public function boncommandeoholiab()
    {
        return view('main.stock.commande_fournisseur.boncommandeoholiab');
    }

    public function boncommandeakebie()
    {
        return view('main.stock.commande_fournisseur.boncommandeakebie');
    }

    public function boncommandeobp()
    {
        return view('main.stock.commande_fournisseur.boncommandeobp');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function addProduct(Request $request)
    {
        //
        $validatedData = $request->validate([
            "commande_id" => "required",
            "product" =>"required",
            "qte" =>"required"
        ]);


        //dd($request->all());

        $commande = CommandeFournisseur::find($request->commande_id);

        $product = Product::find($request->product);

        if($commande->products()->wherePivot('product_id', $product->id)->wherePivot('status', 1)->first() == null) {
            
            $commande->products()->attach($product->id,  
                [
                    "qte" => $request->qte,
                    "prix" => $product->price
                ]
            );
            
            $notification = array(
                "message" => "Vous avez ajouté un nouveau produit à cette commande fournisseur!",
                "alert-type" => "success"
            );
            return redirect()->back()->with($notification);

        }else{
           
            $notification = array(
                "message" => "Le produit que vous essayez d'ajouter à cette commande fournisseur existe déja!",
                "alert-type" => "error"
            );
            return redirect()->back()->with($notification);
        } 

        

    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateProduct(Request $request, $commande, $product)
    {
        //
        //dd($request->all());
        $commande = CommandeFournisseur::find($commande);
        $product = Product::find($product);

        $commande->products()->updateExistingPivot($product->id, [
            'qte' => $request->qte,
        ]);

        $notification = array(
            "message" => "Vous avez modifié la quantité commandée de ".$product->lib,
            "alert-type" => "success"
        );
        return redirect()->back()->with($notification);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deleteProduct($commande, $product)
    {
        //
        $commande = CommandeFournisseur::find($commande);
        $product = Product::find($product);

        $commande->products()->updateExistingPivot($product->id, [
            'status' => 0,
        ]);

        $notification = array(
            "message" => "Vous avez supprimé un produit de cette commande",
            "alert-type" => "success"
        );
        return redirect()->back()->with($notification);
    }

    public function create_bon_livraison(Request $request){

        //dd($request->id_livreur);
        $validatedData = $request->validate([
            "id_livreur" => "required|integer",
        ], [
            "id_livreur.required" => "Le nom du livreur est un champ est requis",
        ]);

        $commande = CommandeFournisseur::find($request->commande_id);
        
        $id_fournisseur = $commande->id_fournisseur;

        if ($id_fournisseur == 1) {
           
            $num_bl="OHOBL-".((int)(Livraison::where('id_entreprise',$id_fournisseur)->count()) + 1);
     
        } elseif($id_fournisseur == 2) {
         
            $num_bl= "AKEBL-".((int)(Livraison::where('id_entreprise',$id_fournisseur)->count()) + 1);
          
        }
        elseif($id_fournisseur == 3) {
            $num_bl = "OBPBL-".((int)(Livraison::where('id_entreprise',$id_fournisseur)->count()) + 1);
        }

        $livraison = new Livraison();
        $livraison->date_reception_livreur = new DateTime();
        $livraison->id_commande = $request->commande_id;
        $livraison->id_livreur = $request->id_livreur;
        $livraison->id_entreprise = $id_fournisseur;
        $livraison->num_bl = $num_bl;
        $livraison->save();

        $commande->update([
            "status" => 2
        ]);

        foreach ($commande->products as $data) {

            $variation = new Variation();

            $variation->typemouv = 0;
            $variation->id_entreprise = $commande->id_fournisseur;
            $variation->id_product = $data->pivot->product_id;
            $variation->production = 0;
            $variation->datemouv = new DateTime();
            $variation->observation = "Vente de produit";
            $variation->datemouv = new DateTime();
            $variation->qte_entree = 0;
            $variation->qte_sortie = $data->pivot->qte;

            $variation->save();
            
        }

        $notification = array(
            "message" => "Vous avez crée un bon de livraison pour cette commande. Consultez la liste des actions dans les détails de cette commande",
            "alert-type" => "success"
        );

        return redirect()->back()->with($notification);
    }

    public function valider($slug)
    {
        $commande = CommandeFournisseur::where('slug', $slug)->first();

        $commande->status = 1;
        $commande->save();

        $notification = array(
            "message" => "Vous avez valider cette commande!",
            "alert-type" => "success"
        );
        
        return redirect()->back()->with($notification);
    }

    public function accept($slug)
    {
        $commande = CommandeFournisseur::where('slug', $slug)->first();

        $commande->status = 7;
        $commande->save();

        $notification = array(
            "message" => "Vous avez valider la commande ".$commande->num_cmd." du client" .$commande->entreprise->nom."!",
            "alert-type" => "success"
        );
        
        return redirect()->back()->with($notification);
    }

    public function rejeter($slug)
    {
        $commande = CommandeFournisseur::where('slug', $slug)->first();
        $commande->status = 4;
        $commande->save();

        $notification = array(
            "message" => "Vous avez rejeter cette commande!",
            "alert-type" => "success"
        );
        
        return redirect()->back()->with($notification);
    }


    public function refuse($slug)
    {
        $commande = CommandeFournisseur::where('slug', $slug)->first();
        $commande->status = 8;
        $commande->save();

        $notification = array(
            "message" => "Vous avez rejeter la commande du client!",
            "alert-type" => "danger"
        );
        
        return redirect()->back()->with($notification);
    }

    public function annuler($slug)
    {
        $commande = CommandeFournisseur::where('slug', $slug)->first();
        $commande->status = 5;
        $commande->save();

        $notification = array(
            "message" => "Vous avez annulé cette commande!",
            "alert-type" => "success"
        );
        
        return redirect()->back()->with($notification);
    }

    public function livrer($slug)
    {
        $commande = CommandeFournisseur::where('slug', $slug)->first();

        foreach ($commande->products as $data) {
            $variation = new Variation();

            $variation->typemouv = 1;
            $variation->id_entreprise = $commande->id_entreprise;
            $variation->id_product = $data->pivot->product_id;
            $variation->production = 0;
            $variation->datemouv = new DateTime();
            $variation->observation = "Achat de produit, reçu du fournisseur ".$commande->fournisseur->nom;
            $variation->datemouv = new DateTime();
            $variation->qte_entree = $data->pivot->qte;
            $variation->qte_sortie = 0;

            $variation->save();

            
        }

        $commande->status = 3;
        $commande->save();

        $livraison = $commande->livraisons->first();

        $livraison->date_reception_client = new DateTime();

        $livraison->save();

        $notification = array(
            "message" => "Vous avez classé cette cette commande comme livrée!",
            "alert-type" => "success"
        );
        
        return redirect()->back()->with($notification);
    }
}
