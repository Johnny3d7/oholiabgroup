@php
    use Carbon\Carbon;
@endphp

@extends('main.achats.partials.main')

@section('title', 'Liste Fiches de factures -')

@section('stylesheets')
<style>
    label {
    margin-top: 35px;
    margin-bottom: 20px !important;
    display: flex;
    margin-bottom: 0.5rem;
}
</style>
@endsection

@section('menuTitle')
Factures
@endsection

@section('pageTitle')
Liste des factures
@endsection

@section('content')
<div class="row mb-4">
    <div class="col-md-12 mb-4">
        <div class="card text-left">

            <div class="card-body">

                @role(config('constants.roles.chgachat'))
                    <a href="{{ route('achats.factures.create') }}" class="btn btn-lg btn-primary ladda-button basic-ladda-button" style="float: right" data-style="expand-right">
                        <span class="ladda-label">Ajouter une facture</span>
                    </a>
                @endrole
                <div class="table-responsive">
                    <table class="display table table-striped table-bordered table_oholiab"  style="width:100%">
                        <thead>
                            <tr>
                                <th>Date d'émission</th>
                                <th>Reference</th>
                                <th>Montant</th>
                                <th>Fournisseur</th>
                                <th>Date de création</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($factures->sortBy('date_emission') as $facture)
                                <tr class="tr-link" data-link="{{ route('achats.factures.show', $facture) }}">
                                    <td class="py-1">{{ ucwords((new Carbon($facture->date_emission))->locale('fr')->isoFormat('DD/MM/YYYY')) }}</td>
                                    <td>{{ ucwords($facture->reference) }}</td>
                                    <td>{{ $facture->montant }}</td>
                                    <td>
                                        <img src="{{ asset($facture->fournisseur->image) }}" class="pt-1" alt="" style="height: 1.5rem;">
                                        {{ $facture->fournisseur->name }}
                                    </td>
                                    <td>{{ ucwords((new Carbon($facture->created_at))->locale('fr')->isoFormat('DD/MM/YYYY à HH:ss')) }}</td>
                                </tr>
                            @empty

                            @endforelse


                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Date d'émission</th>
                                <th>Reference</th>
                                <th>Montant</th>
                                <th>Fournisseur</th>
                                <th>Date de création</th>
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

</script>
@endsection
