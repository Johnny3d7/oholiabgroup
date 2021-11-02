@extends('main.stock.partials.main')

@php
    $entreprise = Auth::user()->entreprise->id;
@endphp

@section('stylesheets')

@endsection

@section('menuTitle')
@if ($entreprise == 1)
Expressions de besoin
@elseif($entreprise == 2 || $entreprise == 3)
Commandes client
@endif

@endsection

@section('pageTitle')
@if ($entreprise == 1)
Liste des expressions de besoin (Site de production)
@elseif($entreprise == 2 || $entreprise == 3)
Liste des commandes client
@endif
@endsection

@section('content')
<section class="contact-list">
    <div class="row">
        <div class="col-md-12 mb-4">
            <div class="card text-left">
                <div class="card-header text-right bg-transparent">
                    
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="display table" id="ul-contact-list" style="width:100%">
                            <thead>
                                <tr>
                                    <th>N°</th>
                                    <th>Client</th>
                                    <th>Contact</th>
                                    <th>Email</th>
                                    <th>Date création</th>
                                    <th>statut</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($commandes as $data)
                                    <tr>
                                        <td>{{ $data->num_cmd }}</td>
                                        <td>{{ $data->entreprise->nom }}</td>
                                        <td>{{ $data->entreprise->contact }}</td>
                                        <td>{{ $data->entreprise->email }}</td>
                                        <td>{{ ucwords((new Carbon\Carbon($data->created_at))->locale('fr')->isoFormat('DD/MM/YYYY')) }}</td>
                                        <td>
                                            @if($data->status == 0)
                                                <a class="badge badge-primary m-2 p-2" href="#">Attente validation</a>
                                            @elseif($data->status == 1)
                                                
                                                    @if (Auth::user()->entreprise->id == $data->id_entreprise)
                                                    <a class="badge badge-success m-2 p-2" href="#">
                                                        Envoyée au fournisseur
                                                    </a>
                                                    @elseif(Auth::user()->entreprise->id == $data->id_fournisseur)
                                                    <a class="badge badge-primary m-2 p-2" href="#">
                                                        Attente de validation
                                                    </a>
                                                    @endif
                                                
                                            @elseif($data->status == 2)
                                                <a class="badge badge-warning m-2 p-2" href="#">
                                                    @if (Auth::user()->entreprise->id == $data->id_entreprise)
                                                        Attente de livraison
                                                    @elseif(Auth::user()->entreprise->id == $data->id_fournisseur)
                                                        Livraison en cours
                                                    @endif
                                                </a>
                                            @elseif($data->status == 3)
                                                <a class="badge badge-success m-2 p-2" href="#">Livrée</a>
                                            @elseif($data->status == 4)
                                                <a class="badge badge-danger m-2 p-2" href="#">Refusée</a>
                                            @elseif($data->status == 5)
                                                <a class="badge badge-danger m-2 p-2" href="#">Annulée</a>
                                            @elseif($data->status == 7)
                                                <a class="badge badge-primary m-2 p-2" href="#">
                                                    @if (Auth::user()->entreprise->id == $data->id_entreprise)
                                                        Validée par fournisseur
                                                    @elseif(Auth::user()->entreprise->id == $data->id_fournisseur)
                                                        Validée
                                                    @endif
                                                </a>
                                            @elseif($data->status == 8)
                                                <a class="badge badge-danger m-2 p-2" href="#">Rejetée</a>
                                            @endif
                                        </td>
                                        <td><a href="{{  route('commande_fournisseur.show',['id'=>$data->id]) }}"><button class="btn btn-outline-warning m-1" type="button">Visualiser</button></a></td>
                                    </tr>    
                                @empty
                                    
                                @endforelse              
                             </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('javascripts')

@endsection