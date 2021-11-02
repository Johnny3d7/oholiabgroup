@extends('main.stock.partials.main')
@php
    $entreprise = Auth::user()->entreprise->id;
@endphp
@section('stylesheets')

@endsection

@section('menuTitle')

@if ($entreprise == 1)
Commandes fournisseur
@elseif($entreprise == 2 || $entreprise == 3)
Expressions de besoin
@endif

@endsection

@section('pageTitle')
@if ($entreprise == 1)
Liste des commandes fournisseurs
@elseif($entreprise == 2 || $entreprise == 3)
Liste des expressions de besoin envoyées
@endif

@endsection

@section('content')
<section class="contact-list">
    <div class="row">
        <div class="col-md-12 mb-4">
            <div class="card text-left">
                <div class="card-header text-right bg-transparent">
                    @if ($entreprise == 1)
                        <a href="{{ route('commande_fournisseur.create') }}"><button class="btn btn-primary btn-md m-1" type="button"><i class="i-Add-User text-white mr-2"></i> Créer une commande fournisseur</button></a> 
                    @elseif($entreprise == 2 || $entreprise == 3)
                        <a href="{{ route('commande_fournisseur.create') }}"><button class="btn btn-primary btn-md m-1" type="button"><i class="i-Add-User text-white mr-2"></i> Etablir une expression de besoin</button></a> 
                    @endif
                    
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="display table" id="ul-contact-list" style="width:100%">
                            <thead>
                                <tr>
                                    <th>N°</th>
                                    <th>Fournisseur</th>
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
                                        <td>{{ $data->fournisseur->nom }}</td>
                                        <td>{{ $data->fournisseur->contact }}</td>
                                        <td>{{ $data->fournisseur->email }}</td>
                                        <td>{{ ucwords((new Carbon\Carbon($data->created_at))->locale('fr')->isoFormat('DD/MM/YYYY')) }}</td>
                                        <td>
                                            @if($data->status == 0)
                                                <a class="badge badge-primary m-2 p-2" href="#">Attente validation</a>
                                            @elseif($data->status == 1)
                                                <a class="badge badge-success m-2 p-2" href="#">
                                                    @if (Auth::user()->entreprise->id == $data->id_entreprise)
                                                        Envoyée au fournisseur
                                                    @elseif(Auth::user()->entreprise->id == $data->id_fournisseur)
                                                        Attente de validation
                                                    @endif
                                                </a>
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
                                                <a class="badge badge-danger m-2 p-2" href="#">Rejetée par fournisseur</a>
                                            @endif
                                        </td>
                                        <td><a href="{{ route('commande_fournisseur.show',['id'=>$data->id]) }}"><button class="btn btn-outline-warning m-1" type="button">Détail</button></a></td>
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