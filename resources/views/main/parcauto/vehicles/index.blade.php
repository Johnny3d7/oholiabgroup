@php
    use Carbon\Carbon;
@endphp

@extends('main.parcauto.partials.main',[
    'pageTitle' => 'Liste des véhicules'
])

@section('stylesheets')
<style>
    .card-icon-bg .card-body .content {
        max-width: 70%;
    }
</style>
@endsection

@section('menuTitle')
Gestion du parc automibile
@endsection

@section('pageTitle')
Liste des véhicules
@endsection

@section('content')
<div class="row mb-4">
    @forelse ($vehicles->sortBy('id_entreprises') as $vehicle)
        <div class="col-lg-3 col-md-4 py-2">
            <a href="{{ route('parcauto.vehicles.show', $vehicle) }}">
                <div class="card">
                    <div class="card-body">
                        <img class="d-block rounded w-100" src="{{ asset($vehicle->image) }}" alt="alt" />
                        <h5 class="card-title my-2 text-truncate" title="{{ $vehicle->libelle }}">{{ $vehicle->libelle }}</h5>
                        {{-- <p class="card-text text-mute text-truncate" title="{{ $vehicle->categorie->libelle }}">{{ $vehicle->categorie->libelle }}</p> --}}
                    </div>
                </div>
            </a>
        </div>
    @empty
        <h6 class="text-center">Aucun véhicule !</h6>
    @endforelse
</div>
@endsection

@section('javascripts')
<script>

</script>
@endsection
