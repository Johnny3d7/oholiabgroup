<?php

namespace App\Http\Controllers\Stock;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;

class AjaxController extends Controller
{
    //
    /*public function getpart($valeur)
    {
        $id  = PartCategorie::where('slug', $slug)->get()[0]->id;
        echo json_encode(CarPart::where('id_part_categorie', $id)->orderBy('lib', 'asc')->get());
    }*/

    public function getCommandeNature($id)
    {
        $cat  = ProductCategory::find($id);
        //dd(Product::where('id_product_category', $cat->id)->orderBy('lib', 'asc')->get());
        echo json_encode(Product::where(['status'=>1,'id_product_category'=> $cat->id])->orderBy('lib', 'asc')->get());
    }

    public function getBonCommandeProduct($id)
    {   
        
        if($id == 1){
            echo json_encode(Product::where('status',1)->whereNotIn('id_product_category',[1,2])->orderBy('lib', 'asc')->get());
        }elseif( $id == 2){
            echo json_encode(Product::where('status',1)->whereIn('id_product_category',[1])->orderBy('lib', 'asc')->get());
        }
        elseif( $id == 3){
            echo json_encode(Product::where('status',1)->whereIn('id_product_category',[2])->orderBy('lib', 'asc')->get());
        }
        else{
            echo json_encode(Product::where('status',1)->whereNotIn('id_product_category',[1,2])->orderBy('lib', 'asc')->get());
        }    
    }

    public function index()
    {
        //
        return view('main.parcauto.index');
    }

}
