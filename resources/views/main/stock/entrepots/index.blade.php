@extends('main.stock.partials.main')

@section('title', 'Liste entrepots -')

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
Entrepôt
@endsection

@section('pageTitle')
Liste des entrepôts
@endsection

@section('content')
<div class="row mb-4">
    @forelse ($entrepots->sortBy('id_entreprises') as $entrepot)
        @php
            $e = $entrepot->entreprise->id;
            $color = ($e == 1) ? 'success' : (($e == 2) ? 'info' : (($e == 3) ? 'primary' : ''));
        @endphp
        <div class="col-lg-3 col-md-4 py-2">
            <a href="{{ route('stock.entrepots.show', $entrepot) }}">
                <div class="card">
                    <div class="card-body text-center">
                        <i class="i-Shop{{ $e <> 1 ? '-'.$e : '' }} text-{{ $color }} text-25 font-weight-500" style="font-size: 150px;"></i>
                        <h5 class="card-title my-2 text-truncate" title="{{ $entrepot->name }}">{{ $entrepot->name }}</h5>
                        <p class="card-text text-mute">{{ $entrepot->lieu }}</p>
                        <span class="rounded" style="position: absolute; top:1rem; right: 0rem; background-color: rgba(218, 201, 201, 0.5)"><img class="m-2" src="{{ asset($entrepot->entreprise->logo) }}" alt="" style="height: 3rem;"></span>
                    </div>
                </div>
            </a>
        </div>
    @empty
        <h6 class="text-center">Aucun entrepôt !</h6>
    @endforelse
    {{-- <div class="col-md-12 mb-4">
        <div class="card text-left">
            
            <div class="card-body">
                <div class="table-responsive">
                    <table class="display table table-striped table-bordered table_oholiab"  style="width:100%">
                        <thead>
                            <tr>
                                <th>Référence</th>
                                <th>Libéllé</th>
                                <th>Entreprise</th>
                                <th>Lieu</th>
                                <th>Date de création</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($entrepots as $entrepot)
                                <tr class="tr-link py-3" data-link="{{ route('stock.entrepots.show', $entrepot) }}">
                                    <td>{{ $entrepot->reference }}</td>
                                    <td>{{ $entrepot->name }}</td>
                                    <td><img style="height: 2em;" class="mr-2" src="{{ asset($entrepot->entreprise->logo) }}" alt="logo_entreprise" />{{ $entrepot->entreprise ? $entrepot->entreprise->name : ''  }}</td>
                                    <td>{{ $entrepot->lieu }}</td>
                                    <td>{{ ucwords((new Carbon\Carbon($entrepot->created_at))->locale('fr')->isoFormat('DD/MM/YYYY')) }}</td>
                                </tr>
                            @empty
                                
                            @endforelse
                            

                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Référence</th>
                                <th>Libéllé</th>
                                <th>Entreprise</th>
                                <th>Lieu</th>
                                <th>Date de création</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div> --}}
</div>
@endsection

@section('javascripts')
<script>

</script>
@endsection