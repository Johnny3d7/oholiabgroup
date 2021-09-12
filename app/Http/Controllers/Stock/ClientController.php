<?php

namespace App\Http\Controllers\Stock;

use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $clients = Client::where('status', 1)->orderBy('nom', 'asc')->get();
        return view('main.stock.client.index', compact('clients'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        /*$notification = array(
            'message' => 'Post created successfully!',
            'alert-type' => 'success'
        );
        return redirect()->route('stock.client.index')->with($notification);*/
        return view('main.stock.client.create');
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
            "nom" => "required|min:2",
            "category" => "required",
            "statut" => "required",
            "adresse" => "required",
            "email" => "required|email|unique:clients",
            "contact" => "required|unique:clients",
        ], [
            "nom.required" => "Le nom est un champ est requis",
            "category.required" => "La catégorie est un champ est requis",
            "statut.required" => "Name is required",
            "adresse.required" => "Name is required",
            "email.required" => "Name is required",
            "email.email" => "Name is required",
            "contact.required" => "Name is required",
        ]);

        $client = Client::create($validatedData);

        /*$code = "";
        $count = Client::where('status','=','1')->count();
        //dd($count);
        if ($count > 0) {
            
            $code = (int)substr(Client::latest()->first()->codeclient, -3) + 1;
        } else {
            $code = 800;
        }
        dd($code);
        if ($code < 10) {
            $code = "00" . $code;
        } elseif($code >= 10 && $code < 100) {
            $code = "0" . $code;
        }
        else{
            return $code;
        }*/
        
        
        $client->codeclient = "CL" . $client->id;
        $client->save();
        $notification = array(
            "message" => "Client ajouter avec succès!",
            "alert-type" => "success"
        );
        
        return redirect()->back()->with($notification);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function show(Client $client)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $client = Client::where('slug', $slug)->first();
        
        //dd($client);
        
        return view('main.stock.client.edit', compact('client'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $slug)
    {
        //
        $validatedData = $request->validate([
            "nom" => "required|min:2",
            "category" => "required",
            "statut" => "required",
            "adresse" => "required",
            "email" => "required|email",
            "contact" => "required",
        ], [
            "nom.required" => "Le nom est un champ est requis",
            "category.required" => "La catégorie est un champ est requis",
            "statut.required" => "Name is required",
            "adresse.required" => "L'adresse est un champ requis",
            "email.required" => "L'email est un champ requis",
            "contact.required" => "Le contact est un champ requis",
        ]);
        $client = Client::where('slug', $slug)->first();
        $client->update($validatedData);
           
        $notification = array(
            "message" => "Client modifié avec succès!",
            "alert-type" => "success"
        );
        
        return redirect()->back()->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        //
        $client = Client::where('slug', $slug)->first();
        $client->status = 0;
        $client->save();
        $notification = array(
            "message" => "Vous avez supprimer un client!",
            "alert-type" => "success"
        );
        
        return redirect()->back()->with($notification);
    }
}
