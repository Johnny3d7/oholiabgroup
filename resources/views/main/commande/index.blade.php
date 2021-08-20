@extends('main.layout.main')

@section('stylesheets')

@endsection

@section('menuTitle')
Commande
@endsection

@section('pageTitle')
Liste des commandes
@endsection

@section('content')
<section class="contact-list">
    <div class="row">
        <div class="col-md-12 mb-4">
            <div class="card text-left">
                <div class="card-header text-right bg-transparent">
                    <a href="{{ route('commande_client.create') }}"><button class="btn btn-primary btn-md m-1" type="button"><i class="i-Add-User text-white mr-2"></i> Ajouter commande</button></a> 
                </div>
                
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="display table" id="ul-contact-list" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Référence</th>
                                    <th>Nom client</th>
                                    <th>Contact client</th>
                                    <th>Date livraison</th>
                                    <th>Lieu livraison</th>
                                    <th>Statut</th>
                                    <th>Date commande</th>
                                    <th>Modification</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($commandes as $data)
                                <tr>
                                    <td>{{ $data->num_cmd }}</td>
                                    <td>{{ $data->client->nom }}</td>
                                    <td>+225 {{ $data->client->contact }}</td>
                                    <td>{{ $data->date_livraison }}</td>
                                    <td>{{ $data->lieu_livraison }}</td>
                                    <td>
                                        @if ($data->status == 1)
                                            <a class="badge badge-primary m-2 p-2" href="#">Vérification stock</a>
                                        @elseif($data->status == 2 )
                                            <a class="badge badge-warning m-2 p-2" href="#">Livraison en cours</a>
                                        @elseif($data->status == 3)
                                            <a class="badge badge-success m-2 p-2" href="#">Livrée</a>
                                        @elseif($data->status == 4)
                                            <a class="badge badge-danger m-2 p-2" href="#">Annulée</a>
                                        @endif
                                    </td>
                                    <td>{{ ucwords((new Carbon\Carbon($data->created_at))->locale('fr')->isoFormat('DD/MM/YYYY')) }}</td>
                                    <td><a class="ul-link-action text-success" href="" data-toggle="tooltip" data-placement="top" title="Modifier"><i class="i-Edit"></i></a><a class="ul-link-action text-danger mr-1" href="{{ route('commande_client.destroy',['slug' => $data->slug]) }}" data-toggle="tooltip" data-placement="top" title="Voulez-vous supprimer ?"><i class="i-Eraser-2"></i></a></td>
                                    <td><a href="{{ route('commande_client.show',['slug'=>$data->slug]) }}"><button class="btn btn-outline-warning m-1" type="button">Détail</button></a></td>
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