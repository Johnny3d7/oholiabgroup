<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // dd(session('routeStack'));
        $categories = Category::mothers();
        return view('admin.products.categories.index', compact('categories'));
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
        if($request->name && $request->name != ''){
            $isset = Category::find($request->id_categories);
            if(!$isset || ($isset && !$isset->category)){
                $category = Category::create([
                    'name' => $request->name,
                    'id_categories' => $request->id_categories ?? null
                ]);
            }

            $notification = array(
                "message" => "Catégorie ajoutée avec succès !",
                "alert-type" => "success"
            );
    
            return redirect()->back()->with($notification);
        }
        return back();
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
    public function update(Request $request, Category $category)
    {
        if($request->name && $request->name != ''){
            $category->update([
                'name' => $request->name,
            ]);

            $notification = array(
                "message" => "Catégorie renommée avec succès !",
                "alert-type" => "success"
            );
    
            return redirect()->back()->with($notification);
        }
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        foreach ($category->categories as $child) {
            $child->delete();
        }
        $category->delete();

        $notification = array(
            "message" => "Catégorie supprimée avec succès !",
            "alert-type" => "success"
        );

        return redirect()->back()->with($notification);
    }
}
