@php
    use Carbon\Carbon;
@endphp

@extends('main.achats.partials.main')

@section('title', 'Liste Fiches de besoins -')

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
Achats effectués
@endsection

@section('pageTitle')
Liste des achats effectués
@endsection

@section('content')
<div class="row mb-4">
    <div class="col-md-12 mb-4">
        <div class="card text-left">

            <div class="card-body">

                <div class="tab-content" style="overflow-x: auto;">
                    <div class="tab-pane fade show active" id="pills-all-besoin" role="tabpanel" aria-labelledby="success-tab">
                        @role("Chargé d'Achats")
                            <a href="{{ route('achats.ligne_factures.create') }}" class="btn btn-lg btn-primary ladda-button basic-ladda-button" style="float: right" data-style="expand-right">
                                <span class="ladda-label">Ajouter un achat</span>
                            </a>
                        @endrole
                        <div class="table-responsive">
                            <table class="display table table-striped table-bordered table_oholiab"  style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Date Facture</th>
                                        <th>Reference Facture</th>
                                        <th>Nature</th>
                                        <th>Entreprise</th>
                                        <th>Date de création</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($lignes as $ligne)
                                        <tr class="tr-link" data-link="{{ route('achats.besoins.show', $ligne->besoin) }}">
                                            <td class="py-1">{{ ucwords((new Carbon($ligne->facture->date_emission))->locale('fr')->isoFormat('DD/MM/YYYY')) }}</td>
                                            <td>{{ $ligne->facture->reference }}</td>
                                            <td>{{ $ligne->ligne_besoin->nature }}</td>
                                            <td>
                                                <img src="{{ asset($ligne->ligne_besoin->besoin->entreprise->logo) }}" class="pt-1" alt="" style="height: 1.5rem;">
                                                {{ $ligne->ligne_besoin->besoin->entreprise->name }}
                                            </td>
                                            <td>{{ ucwords((new Carbon($ligne->created_at))->locale('fr')->isoFormat('DD/MM/YYYY à HH:ss')) }}</td>
                                        </tr>
                                    @empty

                                    @endforelse


                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Date Facture</th>
                                        <th>Reference Facture</th>
                                        <th>Nature</th>
                                        <th>Entreprise</th>
                                        <th>Date de création</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
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
