@extends('main.stock.partials.main')

@section('title', 'Liste inventaires -')

@section('stylesheets')
@endsection

@section('menuTitle')
Inventaires
@endsection

@section('pageTitle')
Liste des inventaires
@endsection

@php
    $actions = [
        config('constants.roles.geststock') => 'vs_inventoriste',
        config('constants.roles.comptable') => 'vs_comptable',
        config('constants.roles.chefcomptable') => 'vs_chef_comptable',
    ];
@endphp

@section('content')
<div class="row mb-4">
    <div class="col-md-12 mb-4">

        <div class="card text-left">

            <div class="card-body">

                <div class="tab-content" style="overflow-x: auto;">
                    <div class="tab-pane fade show active" id="pills-all-inventaire" role="tabpanel" aria-labelledby="success-tab">
                        @hasrole(config('constants.roles.geststock'))
                        <div class="text-center">
                            <a href="{{ route('stock.inventaires.create') }}" class="btn btn-lg btn-primary ladda-button basic-ladda-button" data-style="expand-right">
                                <span class="ladda-label">Ajouter un inventaire</span>
                            </a>
                        </div>
                        @endrole
                        <div class="table-responsive">
                            <table class="display table table-striped table-bordered table_oholiab"  style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Titre</th>
                                        <th>Entrepot</th>
                                        <th>Entreprise</th>
                                        <th>Statut</th>
                                        <th>Visa</th>
                                        <th>Création</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($inventaires->sortByDesc('date_inventaire') as $inventaire)
                                        <tr class="tr-link" data-link="{{ route('stock.inventaires.show', $inventaire) }}">
                                            <td class="py-1">{{ ucwords((new Carbon($inventaire->date_inventaire))->locale('fr')->isoFormat('DD/MM/YYYY')) }}</td>
                                            <td>{{ ucwords($inventaire->name) }}</td>
                                            <td>{{ $inventaire->entrepot->name }}</td>
                                            <td>
                                                <img src="{{ asset($inventaire->entrepot->entreprise->logo) }}" class="pt-1" alt="" style="height: 1.5rem;">
                                                {{ $inventaire->entrepot->entreprise->name }}
                                            </td>
                                            <td>{{ ucfirst($inventaire->statut) }}</td>
                                            <td>
                                                @foreach ($actions as $role => $action)
                                                    @php $color = $inventaire->$action ? 'success' : 'info'; $icon = $inventaire->$action ? 'Yes' : 'Loading-3'; @endphp
                                                    <i class="i-{{ $icon }} text-{{ $color }}" title="{{ $role }}"></i>
                                                @endforeach
                                            </td>
                                            <td class="py-1">{{ ucwords((new Carbon($inventaire->created_at))->locale('fr')->isoFormat('DD/MM/YYYY à HH:mm')) }}</td>
                                        </tr>
                                    @empty

                                    @endforelse


                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Date</th>
                                        <th>Titre</th>
                                        <th>Entrepot</th>
                                        <th>Entreprise</th>
                                        <th>Statut</th>
                                        <th>Visa</th>
                                        <th>Création</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('javascripts')
@endsection
