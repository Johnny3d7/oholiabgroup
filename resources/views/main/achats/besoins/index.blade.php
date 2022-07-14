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
Expressions Besoins
@endsection

@section('pageTitle')
Liste des bons d'expression de besoins
@endsection

@section('content')
<div class="row mb-4">

    <div class="col-md-6 offset-md-3 mb-1">
        <div class="card text-left">
            <div class="card-body">
                <ul class="nav nav-pills nav-justified justify-content-center" id="pills-tab-besoin" role="tablist">
                    {{-- <li class="nav-item">
                        <a class="nav-link active" id="pills-all-besoin-tab" data-toggle="pill" href="#pills-all-besoin" role="tab" aria-controls="pills-all-besoin" aria-selected="true">Toutes</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="pills-valides-besoin-tab" data-toggle="pill" href="#pills-valides-besoin" role="tab" aria-controls="pills-valides-besoin" aria-selected="false">Validées</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="pills-refuses-besoin-tab" data-toggle="pill" href="#pills-refuses-besoin" role="tab" aria-controls="pills-refuses-besoin" aria-selected="false">Refusées</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="pills-attente-besoin-tab" data-toggle="pill" href="#pills-attente-besoin" role="tab" aria-controls="pills-attente-besoin" aria-selected="false">En Attente</a>
                    </li> --}}

                    @php $target = $target ?? 'tous'; @endphp
                    @foreach (['tous', 'validé', 'refusé', 'en attente'] as $statut)
                        <li class="nav-item">
                            <a class="nav-link {{ $target == $statut ? 'active' : '' }}" id="pills-{{ $statut }}-besoin-tab" href="{{ route('achats.besoins.index', ['target' => $statut]) }}" aria-controls="pills-attente-besoin" aria-selected="false">{{ ucfirst($statut) }}</a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
    <div class="col-md-12 mb-4">
        <div class="card text-left">

            <div class="card-body">

                <div class="tab-content" style="overflow-x: auto;">
                    <div class="tab-pane fade show active" id="pills-all-besoin" role="tabpanel" aria-labelledby="success-tab">
                        @role("Chargé d'Achats")
                            <a href="{{ route('achats.besoins.create') }}" class="btn btn-lg btn-primary ladda-button basic-ladda-button" style="float: right" data-style="expand-right">
                                <span class="ladda-label">Ajouter un besoin</span>
                            </a>
                        @endrole
                        <div class="table-responsive">
                            <table class="display table table-striped table-bordered table_oholiab"  style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Date d'émission</th>
                                        <th>Date de livraison</th>
                                        <th>Nature</th>
                                        <th>Entreprise</th>
                                        <th>Statut</th>
                                        <th>Date de création</th>
                                        {{-- <th>Action</th> --}}
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($besoins as $besoin)
                                        <tr class="tr-link" data-link="{{ route('achats.besoins.show', $besoin) }}">
                                            <td class="py-1">{{ ucwords((new Carbon($besoin->date_emission))->locale('fr')->isoFormat('DD/MM/YYYY')) }}</td>
                                            <td>{{ ucwords((new Carbon($besoin->date_livraison))->locale('fr')->isoFormat('DD/MM/YYYY')) }}</td>
                                            <td>{{ $besoin->nature }}</td>
                                            <td>
                                                <img src="{{ asset($besoin->entreprise->logo) }}" class="pt-1" alt="" style="height: 1.5rem;">
                                                {{ $besoin->entreprise->name }}
                                            </td>
                                            <td>{{ ucfirst($besoin->statut) }}</td>
                                            <td>{{ ucwords((new Carbon($besoin->created_at))->locale('fr')->isoFormat('DD/MM/YYYY à HH:ss')) }}</td>
                                            {{-- <td>
                                                <a class="text-info mr-2" href="{{ route('achats.besoins.show', $besoin) }}">
                                                    <i class="nav-icon i-Eye text-16 font-weight-bold"></i>
                                                </a>
                                                <button class="btn " type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <span class="_dot _inline-dot bg-primary"></span>
                                                    <span class="_dot _inline-dot bg-primary"></span>
                                                    <span class="_dot _inline-dot bg-primary"></span>
                                                </button>
                                                <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 33px, 0px); top: 0px; left: 0px; will-change: transform;">
                                                    <a class="dropdown-item ul-widget__link--font" href="{{ route('achats.besoins.show',$besoin) }}"><i class="i-Eye">
                                                        </i> Consulter
                                                    </a>
                                                    <a class="dropdown-item ul-widget__link--font" href="{{ route('achats.besoins.edit', $besoin) }}">
                                                        <i class="i-Edit"> </i> Modifier
                                                    </a>
                                                </div>
                                            </td> --}}
                                            {{-- <td><a href="{{ route('achats.products.show', $data) }}"><button class="btn btn-outline-warning btn-icon m-1" type="button"><span class="ul-btn__icon"><i class="i-Eye"></i></span></button></a><a href="{{ route('achats.products.edit', $data) }}"><button class="btn btn-outline-success btn-icon m-1" type="button"><span class="ul-btn__icon"><i class="i-Edit"></i></span></button></a><a href="{{ route('achats.products.destroy', $data) }}"><button class="btn btn-outline-danger btn-icon m-1" type="button"><span class="ul-btn__icon"><i class="i-Close"></i></span></button></a></td> --}}
                                        </tr>
                                    @empty

                                    @endforelse


                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Date d'émission</th>
                                        <th>Date de livraison</th>
                                        <th>Nature</th>
                                        <th>Entreprise</th>
                                        <th>Statut</th>
                                        <th>Date de création</th>
                                        {{-- <th>Action</th> --}}
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
