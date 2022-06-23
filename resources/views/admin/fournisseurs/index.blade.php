@extends('admin.partials.main')

@section('raccourcis')
    @include('admin.fournisseurs._header')
@endsection

@section('stylesheets')

@endsection

@section('menuTitle')
Fournisseurs
@endsection

@section('pageTitle')
Fournisseurs
@endsection

@section('content')
<div class="row mb-4">
    <div class="col-md-12 mb-4">
        <div class="card text-left">

            <div class="card-body">
                <a href="{{ route('admin.fournisseurs.create') }}">
                    <button class="btn btn-lg btn-primary ladda-button basic-ladda-button" style="float: right"  data-style="expand-right">
                        <span class="ladda-label">Ajouter un fournisseur</span>
                    </button>
                </a>
                <div class="table-responsive">
                    <table class="display table table-striped table-bordered table_oholiab" data-to-export="[0,2,3,4,5,6]" style="width:100%">
                        <thead>
                            <tr>
                                <th>Référence</th>
                                <th>Nom</th>
                                <th>Contact</th>
                                <th>Email</th>
                                <th>Type</th>
                                <th>Date d'ajout</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($fournisseurs as $fournisseur)
                                <tr class="tr-link" data-link="{{ route('admin.fournisseurs.show',$fournisseur) }}">
                                    <td>{{ $fournisseur->reference }}</td>
                                    <td>{{ $fournisseur->name }}</td>
                                    <td>{{ $fournisseur->contact }}</td>
                                    <td>{{ $fournisseur->email }}</td>
                                    <td>{{ $fournisseur->parametre('type')->name }}</td>
                                    <td>{{ ucwords((new Carbon\Carbon($fournisseur->created_at))->locale('fr')->isoFormat('DD/MM/YYYY')) }}</td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('javascripts')

@endsection
