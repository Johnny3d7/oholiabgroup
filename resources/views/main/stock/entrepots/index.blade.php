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
    <div class="col-md-12 mb-4">
        <div class="card text-left">
            
            <div class="card-body">
                
                 <a href="{{-- route('stock.entrepots.create') --}}"><button class="btn btn-lg btn-primary ladda-button basic-ladda-button" style="float: right"  data-style="expand-right"><span class="ladda-label">Ajouter un entrepôt</span></button></a>
                
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
                            @forelse ($entrepots as $entrepot)
                                <tr>
                                    <td>{{ $entrepot->reference }}</td>
                                    <td>{{ $entrepot->name }}</td>
                                    <td>{{ $entrepot->entreprise ? $entrepot->entreprise->name : ''  }}</td>
                                    <td>{{ $entrepot->lieu }}</td>
                                    <td>{{ ucwords((new Carbon\Carbon($entrepot->created_at))->locale('fr')->isoFormat('DD/MM/YYYY')) }}</td>
                                    <td>
                                        <button class="btn " type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <span class="_dot _inline-dot bg-primary"></span>
                                            <span class="_dot _inline-dot bg-primary"></span>
                                            <span class="_dot _inline-dot bg-primary"></span>
                                        </button>
                                        <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 33px, 0px); top: 0px; left: 0px; will-change: transform;">
                                            <a class="dropdown-item ul-widget__link--font" href="{{ route('stock.entrepots.show',$entrepot) }}"><i class="i-Eye">
                                                </i> Consulter
                                            </a>
                                            <a class="dropdown-item ul-widget__link--font" href="{{ route('stock.entrepots.edit', $entrepot) }}">
                                                <i class="i-Edit"> </i> Modifier
                                            </a>
                                        </div>
                                    </td>
                                    {{-- <td><a href="{{ route('stock.products.show', $data) }}"><button class="btn btn-outline-warning btn-icon m-1" type="button"><span class="ul-btn__icon"><i class="i-Eye"></i></span></button></a><a href="{{ route('stock.products.edit', $data) }}"><button class="btn btn-outline-success btn-icon m-1" type="button"><span class="ul-btn__icon"><i class="i-Edit"></i></span></button></a><a href="{{ route('stock.products.destroy', $data) }}"><button class="btn btn-outline-danger btn-icon m-1" type="button"><span class="ul-btn__icon"><i class="i-Close"></i></span></button></a></td> --}}
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
        </div>
    </div>
</div>
@endsection

@section('javascripts')
<script>

</script>
@endsection