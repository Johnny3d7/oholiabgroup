@php
    use Carbon\Carbon;
@endphp

@extends('main.parcinfo.partials.main',[
    'pageTitle' => 'Liste des catégories'
])

@section('stylesheets')
<style>
    .card-icon-bg .card-body .content {
        max-width: 70%;
    }
</style>
@endsection

@section('menuTitle')
Gestion du parc informatique
@endsection

@section('pageTitle')
Liste des catégories
@endsection

@section('content')
<div class="row mb-4">
    @forelse ($types->sortBy('id_entreprises') as $type)
        <div class="col-lg-3 col-md-4 py-2">
            <a href="{{ route('parcinfo.types.show', $type) }}">
                <div class="card">
                    <div class="card-body">
                        <img class="d-block rounded w-100" src="{{ asset($type->image) }}" alt="alt" />
                        <h5 class="card-title my-2 text-truncate" title="{{ $type->libelle }}">{{ $type->libelle }}</h5>
                        <p class="card-text text-mute text-truncate" title="{{ $type->description }}">{{ $type->description }}</p>
                    </div>
                </div>
            </a>
        </div>
    @empty
        <h6 class="text-center">Aucune catégorie !</h6>
    @endforelse
</div>
@endsection

@section('javascripts')
<script>

</script>
@endsection
