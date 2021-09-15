<?php

namespace App\Http\Controllers\Stock;

use App\Http\Controllers\Controller;
use App\Models\BonCommande;
use App\Models\Commande;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BonCommandeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $bonCommandes = BonCommande::whereIn('status', [0,1,2,3,5])->orderBy('created_at', 'desc')->get();
        return view('main.stock.bon_commande.index',compact('bonCommandes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('main.stock.bon_commande.create');
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
            "id_fournisseur" => "required|integer",
            "product.*" =>"required",
            "qte.*" =>"required",
            "prix.*" =>"required"
        ], [
            "id_fournisseur.required" => "Le nom du client est un champ est requis",
        ]);
        //dd($request->hasFile('proforma'));

        $bonCommande = BonCommande::create([
            "id_fournisseur" => $request->id_fournisseur,
            "date_livraison" => $request->date_livraison,
            "lieu_livraison" => $request->lieu_livraison
        ]);

        $image = $request->file('proforma');


        if ($request->file()) {

            $fileName = $image->getClientOriginalName() . '_' . time() . '_' . rand(9, 999) . '.' . $image->extension();

            $path = $image->storeAs('proforma', $fileName, 'public');

            $bonCommande->proforma = $fileName;

            $bonCommande->proforma_path = 'storage/' . $path;

            $bonCommande->save();
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

            $bonCommande->products()->attach($data->id,  
                [
                    "qte" => $tabqte[$i],
                    "prix" => $request->prix[$i]
                ]
            );

           $i++;
        }

        $notification = array(
            "message" => "Le bon de commande à été enregistrée avec succès !",
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
        $bonCommande = BonCommande::find($id);
        return view('main.stock.bon_commande.show',compact('bonCommande'));
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

    //Ajouter des produits au bon de commande
    public function addProduct(Request $request)
    {
        //
        $validatedData = $request->validate([
            "bon_commande_id" => "required",
            "product" =>"required",
            "prix" =>"required",
            "qte" =>"required"
        ]);

        $bonCommande = BonCommande::find($request->bon_commande_id);

        $product = Product::find($request->product);

        if($bonCommande->products()->wherePivot('product_id', $product->id)->wherePivot('status', 1)->first() == null) {
            
            $bonCommande->products()->attach($product->id,  
                [
                    "qte" => $request->qte,
                    "prix" => $request->prix
                ]
            );
            
            $notification = array(
                "message" => "Vous avez ajouté un nouveau produit au bon de commande!",
                "alert-type" => "success"
            );
            return redirect()->back()->with($notification);

        }else{
           
            $notification = array(
                "message" => "Le produit que vous essayez d'ajouter au bon de commande existe déja!",
                "alert-type" => "error"
            );
            return redirect()->back()->with($notification);
        } 

        

    }

    public function updateProduct(Request $request, $bonCommande, $product)
    {
        //
        //dd($request->all());
        $bonCommande = BonCommande::find($bonCommande);
        $product = Product::find($product);

        $bonCommande->products()->updateExistingPivot($product->id, [
            'prix' => $request->prix,
            'qte' => $request->qte
        ]);

        $notification = array(
            "message" => "Vous avez modifié un produit du bon de commande",
            "alert-type" => "success"
        );
        return redirect()->back()->with($notification);
    }

    //Supprimer un produit du bon de commande
    public function deleteProduct($bonCommande, $product)
    {
        //
        $bonCommande = BonCommande::find($bonCommande);
        $product = Product::find($product);

        $bonCommande->products()->updateExistingPivot($product->id, [
            'status' => 0,
        ]);

        $notification = array(
            "message" => "Vous avez supprimé un produit du bon de commande",
            "alert-type" => "success"
        );
        return redirect()->back()->with($notification);
    }

    public function addProforma(Request $request,$id)
    {
        //
        dd($request->hasFile('proforma'));
        
       
        $notification = array(
            "message" => "Vous avez attaché une pro-forma au bon de commande",
            "alert-type" => "success"
        );
        return redirect()->back()->with($notification);
    }

    public function viewcommande($slug)
    {
        //
        $commande = Commande::where('slug', $slug)->first();
        return view('main.stock.bon_commande.viewcommande',compact('commande'));
    }



}
