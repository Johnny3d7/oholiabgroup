<?php

namespace App\Http\Controllers\Stock;

use App\Http\Controllers\Controller;
use App\Models\Commande;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CommandeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $commandes = Commande::whereIn('status', [1,2,3,4])->orderBy('created_at', 'desc')->get();
        //dd($commandes);
        return view('main.commande.index',compact('commandes'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function boncommande()
    {
        //
        //$clients = Client::where('status', 1)->orderBy('nom', 'asc')->get();
        return view('main.commande.bon_commande_index');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function expressionbesoin()
    {
        //
        //$clients = Client::where('status', 1)->orderBy('nom', 'asc')->get();
        return view('main.commande.expression_besoin');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('main.commande.client.create');
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
        //dd($request->date_livraison);
        $validatedData = $request->validate([
            "id_client" => "required|integer",
            "type" => "required|integer",
            "canal_reception" => "required",
            "mode_reglement" => "required",
            "date_livraison" => "required",
            "lieu_livraison" => "required",
            "product.*" =>"required",
            "qte.*" =>"required"
        ], [
            "id_client.required" => "Le nom du client est un champ est requis",
            "type.required" => "La nature de la commande est un champ est requis",
            "canal_reception.required" => "Le canal de réception est un champ est requis",
            "mode_reglement.required" => "Le mode de règlement est un champ est requis",
            "date_livraison.required" => "La date de livraison est un champ est requis",
            "lieu_livraison.required" => "Le lieu de livraison est un champ est requis",
        ]);

        $commande = Commande::create([
            "id_client" => $request->id_client,
            "type" => $request->type,
            "canal_reception" => $request->canal_reception,
            "mode_reglement" => $request->mode_reglement,
            "date_livraison" => $request->date_livraison,
            "lieu_livraison" => $request->lieu_livraison
        ]);

        $commande->update([
            "num_cmd" => "COMD".$commande->id
        ]);

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
                    "prix" => $data->price
                ]
            );

           $i++;
        }

        $notification = array(
            "message" => "La commande cliente à été enregistrée avec succès !",
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
    public function show($slug)
    {
        //
        $commande = Commande::where('slug', $slug)->first();
        return view('main.commande.client.show',compact('commande'));
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
    public function destroy($slug)
    {
        //
        $commande = Commande::where('slug', $slug)->first();
        $commande->status = 5;
        $commande->save();

        $notification = array(
            "message" => "Vous avez supprimer une commande!",
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
    public function addProduct(Request $request)
    {
        //
        $validatedData = $request->validate([
            "commande_id" => "required",
            "product" =>"required",
            "qte" =>"required"
        ]);


        //dd($request->all());

        $commande = Commande::find($request->commande_id);

        $product = Product::find($request->product);

        if($commande->products()->wherePivot('product_id', $product->id)->wherePivot('status', 1)->first() == null) {
            
            $commande->products()->attach($product->id,  
                [
                    "qte" => $request->qte,
                    "prix" => $product->price
                ]
            );
            
            $notification = array(
                "message" => "Vous avez ajouté un nouveau produit à cette commande!",
                "alert-type" => "success"
            );
            return redirect()->back()->with($notification);

        }else{
           
            $notification = array(
                "message" => "Le produit que vous essayez d'ajouter à cette commande existe déja!",
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
        $commande = Commande::find($commande);
        $product = Product::find($product);

        $commande->products()->updateExistingPivot($product->id, [
            'qte' => $request->qte,
        ]);

        $notification = array(
            "message" => "Vous avez modifié la quantité commandé de ".$product->lib,
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
        $commande = Commande::find($commande);
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
}
