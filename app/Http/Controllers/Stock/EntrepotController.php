<?php

namespace App\Http\Controllers\Stock;

use App\Http\Controllers\Controller;
use App\Models\Entrepot;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class EntrepotController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $entrepots = Entrepot::where(['status'=>1])->get();
        return view('main.stock.entrepot.index', compact('entrepots'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('main.stock.entrepot.create');

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
        $validatedData = Validator::make($request->all(),[
            
            'lib' => 'required|string' ,
            'id_entreprise'=> 'required|integer',
            'lieu' => 'string',
            'contact' => 'min:21|string',
        ], [
            "lib.required" => "Le nom de l'entrepôt est obligatoire.",
            "lib.string" => "Le nom de l'entrepôt doit être une chaîne de caractères.",
            'id_entreprise.required' => 'Le choix de l\'entreprise est obligatoire.' ,
            'id_entreprise.integer' => 'L\'entreprise doit être une valeur entière.' ,
            "lieu.string" => "Le lieu de l'entrepôt doit être une chaîne de caractères.",
            "contact.string" => "Le contact de l'entrepôt doit être une chaîne de caractères.",
        ]);

        if ($validatedData->fails()) {
            $notification = array(
                "message" => "Le formulaire n'est pas valide, veuillez réessayer s'il vous plaît !",
                "alert-type" => "error"
            );
            return redirect()->back()->withErrors($validatedData)->withInput()->with($notification);
        }
        else{
            //dd(Auth::user()->id);
            $suffix= "ENT";
            $order = $this->generate_order(Entrepot::where('status',1)->count());

            $entrepot = Entrepot::create([
                'ref'=> $suffix.$order,
                'lib' => $request->lib,
                'contact' => $request->contact,
                'lieu' => $request->lieu,
                'id_entreprise' => $request->id_entreprise,
                'id_recorder' => Auth::user()->id
            ]);
            
            
            
            $notification = array(
                "message" => "Votre nouvel entrepôt vient d'être crée!",
                "alert-type" => "success"
            );

            return redirect()->back()->with($notification);
        }
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

        $entrepot = Entrepot::where(['slug'=>$slug])->first();
        dd($entrepot->produits()[0]->stock_physique_entrepot($entrepot));
        $products = DB::table('variations')->distinct()
        ->join('products', 'products.id', '=', 'variations.id_product')
        ->join('entrepots', 'entrepots.id', '=', 'variations.id_entrepot')
        ->join('products_categories', 'products_categories.id', '=', 'products.id_product_category')
        ->where('variations.status', '=', 1)
        ->where('products.status', '=', 1)
        ->select('products.*','products_categories.lib as category',
        DB::raw('SUM(variations.qte_entree) as total_entree'),
        DB::raw('SUM(variations.qte_sortie) as total_sortie'),
        DB::raw('SUM(variations.qte_entree) - SUM(variations.qte_sortie) as total_stock'))
        ->where('variations.id_entrepot', '=', $entrepot->id)->groupBy('products.id')->get();

        dd($products);

        return view('main.stock.entrepot.show', compact('entrepot'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        //
        $entrepot = Entrepot::where(['slug'=>$slug])->first();

        return view('main.stock.entrepot.edit',compact('entrepot'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $slug)
    {
        //
        $validatedData = Validator::make($request->all(),[
            
            'lib' => 'required|string' ,
            'id_entreprise'=> 'required|integer',
            'lieu' => 'string',
            'contact' => 'string',
        ], [
            "lib.required" => "Le nom de l'entrepôt est obligatoire.",
            "lib.string" => "Le nom de l'entrepôt doit être une chaîne de caractères.",
            'id_entreprise.required' => 'Le choix de l\'entreprise est obligatoire.' ,
            'id_entreprise.integer' => 'L\'entreprise doit être une valeur entière.' ,
            "lieu.string" => "Le lieu de l'entrepôt doit être une chaîne de caractères.",
            "contact.string" => "Le contact de l'entrepôt doit être une chaîne de caractères.",
        ]);

        if ($validatedData->fails()) {
            $notification = array(
                "message" => "Le formulaire n'est pas valide, veuillez réessayer s'il vous plaît !",
                "alert-type" => "error"
            );
            return redirect()->back()->withErrors($validatedData)->withInput()->with($notification);
        }
        else{
         
            
            $entrepot = Entrepot::where(['slug'=>$slug])->first();

            $entrepot->update([
                'lib' => $request->lib,
                'contact' => $request->contact,
                'lieu' => $request->lieu,
                'id_entreprise' => $request->id_entreprise,
            ]);
            
            $notification = array(
                "message" => "Cet entrepôt vient d'être modifié!",
                "alert-type" => "success"
            );

            return redirect()->back()->with($notification);
        }
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
        $entrepot = Entrepot::find($slug);
        $entrepot->status = 0;
        $entrepot->save();

        $notification = array(
            "message" => "Vous avez supprimé un entrepôt!",
            "alert-type" => "success"
        );

        return redirect()->route('store.entrepot.index')->with($notification);
    }

    public function generate_order($nb){

        $nb = $nb +1;

        if ($nb < 10) {
            $no = "000".$nb; 
        } elseif($nb < 100) {
            $no = "00".$nb;
        }elseif($nb < 1000) {
            $no = "0".$nb;
        }elseif($nb < 10000) {
            $no = $nb;
        }

        return $no;
    }
}
