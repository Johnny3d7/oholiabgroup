@extends('main.stock.partials.main')

@section('stylesheets')

@endsection

@section('menuTitle')
Client
@endsection

@section('pageTitle')
Liste des clients
@endsection

@section('content')
<div class="row mb-4">
    <div class="col-md-12 mb-4">
        <div class="card text-left">
            
            <div class="card-body">
                
                <a href="{{ route('stock.client.create') }}"><button class="btn btn-lg btn-primary ladda-button basic-ladda-button" style="float: right" data-style="expand-right"><span class="ladda-label">Ajouter un client</span></button></a>
                
                <div class="table-responsive">
                    <table id="clientsTable" class="display table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>Code</th>
                                <th>Nom</th>
                                <th>Contact</th>
                                <th>Catégorie</th>
                                <th>statut</th>
                                <th>Localisation</th>
                                <th>Date d'ajout</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($clients as $client)
                            <tr>
                                <td>{{$client->codeclient}}</td>
                                <td>{{$client->nom}}</td>
                                <td>{{$client->contact}}</td>
                                <td>{{$client->category}}</td>
                                <td>{{$client->statut}}</td>
                                <td>{{$client->adresse}}</td>
                                <td>{{ ucwords((new Carbon\Carbon($client->created_at))->locale('fr')->isoFormat('DD/MM/YYYY')) }}</td>
                                <td>
                                    <a href="{{ route('stock.client.edit', ['slug'=>$client->slug]) }}">
                                        <button class="btn btn-outline-success m-1" type="button">Modifier</button>
                                    </a>
                                    <a href="{{ route('stock.client.destroy', ['slug'=>$client->slug]) }}">
                                        <button class="btn btn-outline-danger m-1" type="button">Supprimer</button>
                                    </a>

                                    {{--  
                                    <form method="GET" action="{{ route('stock.client.index') }}">
                                        @csrf
                                        <input name="_method" type="hidden" value="DELETE">
                                        <button class="btn btn-outline-danger m-1" id="alert-confirm" type="submit">Supprimer</button>
                                    </form>--}}
                                </td>

                            </tr>
                            @endforeach
                            
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Code</th>
                                <th>Nom</th>
                                <th>Contact</th>
                                <th>Catégorie</th>
                                <th>statut</th>
                                <th>Localisation</th>
                                <th>Date d'ajout</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('javascripts')
<script>
    $(document).ready(function() {
    $('#clientsTable').DataTable({
        "order": [[ 1, "asc" ]],
        paging: true,
        searching: true,
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    } );
} );
</script>
@endsection