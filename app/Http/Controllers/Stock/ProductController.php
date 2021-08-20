<?php

namespace App\Http\Controllers\Stock;

use App\Http\Controllers\Controller;
use App\Models\Entreprise;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $products = Product::where('status', 1)->orderBy('lib', 'asc')->get();

        return view('main.product.index',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('main.product.create');
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
            "lib" => "required|min:2",
            "price" => "required",
            "stockalert" => "required|integer",
            "id_product_category" => "required",
            "id_type_product" => "required"

        ], [
            "lib.required" => "Le libellé est un champ est requis",
            "price.required" => "Le prix unitaire est un champ est requis",
            "stockalert.required" => "Le stock alerte est un champ requis",
            "id_type_product.required" => "Le type du produit est un champ requis",
            "id_product_category.required" => "La catégorie du produit est un champ requis"
        ]);

        $dimension = explode("x", $request->dimension);

        if ($request->dimension == null) {
            $product = Product::create([
                'lib'=>$request->lib,
                'price'=>$request->price,
                'stockalert'=>$request->stockalert,
                'poids'=>$request->poids,
                'unite_poids'=>$request->unite_poids,
                'longueur'=>"0",
                'largeur'=>"0",
                'hauteur'=>"0",
                'unite_mesure'=>$request->unite_mesure,
                'volume'=>$request->volume,
                'unite_volume'=>$request->unite_volume,
                'id_product_category'=>$request->id_product_category,
                'id_type_product'=>$request->id_type_product
            ]);
        }elseif ($request->dimension != null) {
            if ($dimension[1] == "" || $dimension[2] == "" ) {
                $notification = array(
                    "message" => "Les dimensions du produit sont incorrectes!",
                    "alert-type" => "error"
                );
                
                return redirect()->back()->with($notification);
            }else {
                $product = Product::create([
                    'lib'=>$request->lib,
                    'price'=>$request->price,
                    'stockalert'=>$request->stockalert,
                    'poids'=>$request->poids,
                    'unite_poids'=>$request->unite_poids,
                    'longueur'=>$dimension[0],
                    'largeur'=>$dimension[1],
                    'hauteur'=>$dimension[2],
                    'unite_mesure'=>$request->unite_mesure,
                    'volume'=>$request->volume,
                    'unite_volume'=>$request->unite_volume,
                    'id_product_category'=>$request->id_product_category,
                    'id_type_product'=>$request->id_type_product
                ]);
                
            }
        }
        

        $product->ref = "P". $product->id;
        $product->save();
        //dd($product);
        $notification = array(
            "message" => "Votre nouveau produit est ajouté au stock!",
            "alert-type" => "success"
        );
        
        return redirect()->back()->with($notification);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        
        $product = Product::where('slug', $slug)->first();

        return view('main.product.edit',compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $slug)
    {
        //
        $validatedData = $request->validate([
            "lib" => "required|min:2",
            "price" => "required",
            "stockalert" => "required|integer",
            "id_product_category" => "required",
            "id_type_product" => "required"

        ], [
            "lib.required" => "Le libellé est un champ est requis",
            "price.required" => "Le prix unitaire est un champ est requis",
            "stockalert.required" => "Le stock alerte est un champ requis",
            "id_type_product.required" => "Le type du produit est un champ requis",
            "id_product_category.required" => "La catégorie du produit est un champ requis"
        ]);
        
        $dimension = explode("x", $request->dimension);
        //dd($dimension);
        $product = Product::where('slug', $slug)->first();

        if ($request->dimension == null) {
            $product->update([
                'lib'=>$request->lib,
                'price'=>$request->price,
                'stockalert'=>$request->stockalert,
                'poids'=>$request->poids,
                'unite_poids'=>$request->unite_poids,
                'longueur'=>"0",
                'largeur'=>"0",
                'hauteur'=>"0",
                'unite_mesure'=>$request->unite_mesure,
                'volume'=>$request->volume,
                'unite_volume'=>$request->unite_volume,
                'id_product_category'=>$request->id_product_category,
                'id_type_product'=>$request->id_type_product
            ]);
        }elseif ($request->dimension != null) {
            if ($dimension[1] == "" || $dimension[2] == "" ) {
                $notification = array(
                    "message" => "Les dimensions du produit sont incorrectes!",
                    "alert-type" => "error"
                );
                
                return redirect()->back()->with($notification);
            }
            else{
                $product->update([
                    'lib'=>$request->lib,
                    'price'=>$request->price,
                    'stockalert'=>$request->stockalert,
                    'poids'=>$request->poids,
                    'unite_poids'=>$request->unite_poids,
                    'longueur'=>$dimension[0],
                    'largeur'=>$dimension[1],
                    'hauteur'=>$dimension[2],
                    'unite_mesure'=>$request->unite_mesure,
                    'volume'=>$request->volume,
                    'unite_volume'=>$request->unite_volume,
                    'id_product_category'=>$request->id_product_category,
                    'id_type_product'=>$request->id_type_product
                ]);
            }
        }
        
        
        //$product->update($validatedData);

        

        $product->save();

        $notification = array(
            "message" => "Le produit à été modifié avec succès!",
            "alert-type" => "success"
        );
        
        return redirect()->back()->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        //
        $product = Product::where('slug', $slug)->first();
        $product->status = 0;
        $product->save();
        $notification = array(
            "message" => "Vous avez supprimer un produit de cette liste!",
            "alert-type" => "success"
        );
        
        return redirect()->back()->with($notification);
    }

    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function etatstock($slug)
    {
        //
        $entreprise = Entreprise::where('slug', $slug)->first();

        $products = DB::table('variations')->distinct()
        ->join('products', 'products.id', '=', 'variations.id_product')
        ->join('entreprises', 'entreprises.id', '=', 'variations.id_entreprise')
        ->join('products_categories', 'products_categories.id', '=', 'products.id_product_category')
        ->select('products.*','products_categories.lib as category',
        DB::raw('SUM(variations.qte_entree) as total_entree'),
        DB::raw('SUM(variations.qte_sortie) as total_sortie'),
        DB::raw('SUM(variations.qte_entree) - SUM(variations.qte_sortie) as total_stock'))
        ->where('variations.id_entreprise', '=', $entreprise->id)->groupBy('products.id')->get();
        //dd($products);

        return view('main.product.etatstock', compact('products','entreprise'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function stockStory($entreprise,$slug)
    {
        $entreprise = Entreprise::where('slug', $entreprise)->first();
        $prod = Product::where('slug', $slug)->first();

        $variations = DB::table('variations')->distinct()
        ->join('products', 'products.id', '=', 'variations.id_product')
        ->join('entreprises', 'entreprises.id', '=', 'variations.id_entreprise')
        ->select('variations.*','products.lib as product_lib')
        ->where('variations.id_entreprise', '=', $entreprise->id)
        ->where('products.id', '=', $prod->id)
        ->where('variations.status', '=',1)
        ->orderByDesc('variations.created_at')
        ->groupBy('variations.id')->get();

        //dd($variations);

        return view('main.product.stockstory', compact('variations'));
    }
}
