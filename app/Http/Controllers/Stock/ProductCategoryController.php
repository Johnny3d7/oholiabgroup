<?php

namespace App\Http\Controllers\Stock;

use App\Http\Controllers\Controller;
use App\Models\ProductCategory;
use Illuminate\Http\Request;

class ProductCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $productCategory = ProductCategory::where('status', 1)->orderBy('lib', 'asc')->get();

        return view('main.category_prod.index',compact('productCategory'));
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
        //dd($request->commercialisable);
        $validatedData = $request->validate([
            "lib" => "required|min:3|unique:products_categories,lib"
        ], [
            "lib.required" => "Le libellé est un champ est requis",
            "lib.unique" => "Le produit saisie existe déja, contactez l'administrateur en cas d'incompréhension !"
        ]);

        $productCategory = ProductCategory::create($validatedData);

        if($request->commercialisable == "on"){

            $productCategory->update([
                'commercialisable' => 1
            ] );

            $productCategory->save();
        }
        

        $notification = array(
            "message" => "Catégorie ajouter avec succès!",
            "alert-type" => "success"
        );
        
        return redirect()->back()->with($notification);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProductCategory  $productCategory
     * @return \Illuminate\Http\Response
     */
    public function show(ProductCategory $productCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProductCategory  $productCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductCategory $productCategory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ProductCategory  $productCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $slug)
    {
        //
        $validatedData = $request->validate([
            "lib" => "required|min:3",
        ], [
            "lib.required" => "Le libellé est un champ est requis",
        ]);

        $productCategory = ProductCategory::where('slug', $slug)->first();

        $productCategory->update($validatedData);

        if($request->commercialisable == "on"){

            $productCategory->update([
                'commercialisable' => 1
            ] );

            $productCategory->save();
        }

           
        $notification = array(
            "message" => "Catégorie produit modifié avec succès!",
            "alert-type" => "success"
        );
        
        return redirect()->back()->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProductCategory  $productCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        //
        $productCategory = ProductCategory::where('slug', $slug)->first();
        $productCategory->status = 0;
        $productCategory->save();
        $notification = array(
            "message" => "Vous avez supprimer une catégorie!",
            "alert-type" => "success"
        );
        
        return redirect()->back()->with($notification);
    }
}
