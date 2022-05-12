<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\EntrepotsHasProduct;
use App\Models\Entreprise;
use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();
        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $entreprises = Entreprise::all();
        return view('admin.products.create', compact('categories', 'entreprises'));
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
            "name" => "required|min:2",
            "type" => "required",
            "nature" => "required",
            "unite" => "required",
            "id_categories" => "required",
            "id_entreprises" => "required"

        ], [
            "name.required" => "Le nom est un champ est requis",
            "name.min" => "Le nom doit comporter au moins 02 caractères",
            "type.required" => "Le type est un champ requis",
            "nature.required" => "La nature est un champ requis",
            "unite.required" => "L'unité est un champ requis",
            "id_categories.required" => "Le type du produit est un champ requis",
            "id_entreprises.required" => "L'entreprise de production du produit est un champ requis"
        ]);

        $product = Product::create([
            'name' => $request->name,
            'type' => $request->type,
            'nature' => $request->nature,
            'unite' => $request->unite,
            'image' => $request->image,
            'description' => $request->description,
            'id_categories' => $request->id_categories,
            'id_entreprises' => $request->id_entreprises,
        ]);

        if ($image = $request->file('image')) {
            $name = $request->name;
            $fileName = str_replace(' ', '_', $name) . '_' . time() . '.' . $image->extension();
            $path = $image->storeAs('Products', $fileName, 'public');
            $product->image = 'storage/' . $path;
            $product->save();        
        }

        $notification = array(
            "message" => "Votre nouveau produit est ajouté au stock!",
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
