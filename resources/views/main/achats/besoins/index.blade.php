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
Liste des fiches de besoins
@endsection

@section('content')
<div class="row mb-4">

    <div class="col-md-6 offset-md-3 mb-1">
        <div class="card text-left">
            <div class="card-body">
                <ul class="nav nav-pills nav-justified justify-content-center" id="pills-tab-besoin" role="tablist">
                    <li class="nav-item">
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
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="col-md-12 mb-4">
        <div class="card text-left">
            
            <div class="card-body">
                
                <div class="tab-content" style="overflow-x: auto;">
                    <div class="tab-pane fade show active" id="pills-all-besoin" role="tabpanel" aria-labelledby="success-tab">
                        <a href="{{ route('achats.besoins.create') }}" class="btn btn-lg btn-primary ladda-button basic-ladda-button" style="float: right" data-style="expand-right">
                            <span class="ladda-label">Ajouter un besoin</span>
                        </a>
                        <div class="table-responsive">
                            <table class="display table table-striped table-bordered table_oholiab"  style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Référence</th>
                                        <th>Libéllé</th>
                                        <th>Entreprise</th>
                                        <th>Lieu</th>
                                        <th>Date de création</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($besoins as $besoin)
                                        <tr>
                                            <td>{{ $besoin->reference }}</td>
                                            <td>{{ $besoin->name }}</td>
                                            <td>{{ $besoin->entreprise ? $besoin->entreprise->name : ''  }}</td>
                                            <td>{{ $besoin->lieu }}</td>
                                            <td>{{ ucwords((new Carbon\Carbon($besoin->created_at))->locale('fr')->isoFormat('DD/MM/YYYY')) }}</td>
                                            <td>
                                                <button class="btn " type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <span class="_dot _inline-dot bg-primary"></span>
                                                    <span class="_dot _inline-dot bg-primary"></span>
                                                    <span class="_dot _inline-dot bg-primary"></span>
                                                </button>
                                                <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 33px, 0px); top: 0px; left: 0px; will-change: transform;">
                                                    <a class="dropdown-item ul-widget__link--font" href="{{ route('achats.entrepots.show',$besoin) }}"><i class="i-Eye">
                                                        </i> Consulter
                                                    </a>
                                                    <a class="dropdown-item ul-widget__link--font" href="{{ route('achats.entrepots.edit', $besoin) }}">
                                                        <i class="i-Edit"> </i> Modifier
                                                    </a>
                                                </div>
                                            </td>
                                            {{-- <td><a href="{{ route('achats.products.show', $data) }}"><button class="btn btn-outline-warning btn-icon m-1" type="button"><span class="ul-btn__icon"><i class="i-Eye"></i></span></button></a><a href="{{ route('achats.products.edit', $data) }}"><button class="btn btn-outline-success btn-icon m-1" type="button"><span class="ul-btn__icon"><i class="i-Edit"></i></span></button></a><a href="{{ route('achats.products.destroy', $data) }}"><button class="btn btn-outline-danger btn-icon m-1" type="button"><span class="ul-btn__icon"><i class="i-Close"></i></span></button></a></td> --}}
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
                                        <th>Action</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="pills-valides-besoin" role="tabpanel" aria-labelledby="warning-tab">
                        <h6 class="text-center">Aucune fiche de besoin validée</h6>
                    </div>
                    <div class="tab-pane fade" id="pills-refuses-besoin" role="tabpanel" aria-labelledby="errors-tab">
                        <h6 class="text-center">Aucune fiche de besoin rejetée</h6>
                    </div>
                    <div class="tab-pane fade" id="pills-attente-besoin" role="tabpanel" aria-labelledby="errors-tab">
                        <h6 class="text-center">Aucune fiche de besoin en attente</h6>
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