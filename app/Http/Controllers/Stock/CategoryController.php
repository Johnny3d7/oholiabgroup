<?php

namespace App\Http\Controllers\Stock;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $productCategory = Category::all();

        return view('main.stock.categories.index',compact('productCategory'));
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

        $productCategory = Category::create($validatedData);

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
     * @param  \App\Models\Category  $productCategory
     * @return \Illuminate\Http\Response
     */
    public function show(Category $productCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $productCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $productCategory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $productCategory
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

        $productCategory = Category::where('slug', $slug)->first();

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
     * @param  \App\Models\Category  $productCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        //
        $productCategory = Category::where('slug', $slug)->first();
        $productCategory->status = 0;
        $productCategory->save();
        $notification = array(
            "message" => "Vous avez supprimer une catégorie!",
            "alert-type" => "success"
        );
        
        return redirect()->back()->with($notification);
    }

    public function mail()
    {
        $data= ['name'=>"Vishal",'data'=>"Hello Vishal"];
        $user['to']='sergeregisb466@gmail.com'; 
        Mail::send('main.mail', $data, function ($message) use ($user) {
            $message->to($user['to'], 'Serge BLE');
            $message->cc($user['to'], 'Serge BLE');
            $message->bcc($user['to'], 'Serge BLE');
            $message->replyTo($user['to'], 'Serge BLE');
            $message->subject('Liste des produits en rupture de stock');
        });
    }
}
