@extends('main.layout.main')

@section('stylesheets')

@endsection

@section('menuTitle')
Commande
@endsection

@section('pageTitle')
Liste des bons de commande
@endsection

@section('content')
<section class="contact-list">
    <div class="row">
        <div class="col-md-12 mb-4">
            <div class="card text-left">
                <div class="card-header text-right bg-transparent">
                    <a href="{{ route('boncommande.create') }}"><button class="btn btn-primary btn-md m-1" type="button"><i class="i-Add-User text-white mr-2"></i> Établir un bon de commande</button></a> 
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="display table" id="ul-contact-list" style="width:100%">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Fournisseur</th>
                                    <th>Contact</th>
                                    <th>Email</th>
                                    <th>Date création</th>
                                    <th>statut</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($bonCommandes as $data)
                                    <tr>
                                        <td>{{ $data->id }}</td>
                                        <td>{{ $data->fournisseur->nom }}</td>
                                        <td>{{ $data->fournisseur->contact }}</td>
                                        <td>{{ $data->fournisseur->email }}</td>
                                        <td>{{ ucwords((new Carbon\Carbon($data->created_at))->locale('fr')->isoFormat('DD/MM/YYYY')) }}</td>
                                        <td>
                                            @if($data->status == 0)
                                                <a class="badge badge-primary m-2 p-2" href="#">Attente validation</a>
                                            @elseif($data->status == 1)
                                                <a class="badge badge-success m-2 p-2" href="#">Validé</a>
                                            @elseif($data->status == 2)
                                                <a class="badge badge-danger m-2 p-2" href="#">Rejetté</a>
                                            @endif
                                        </td>
                                        <td><a href="{{ route('boncommande.show',['id'=>$data->id]) }}"><button class="btn btn-outline-warning m-1" type="button">Détail</button></a></td>
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