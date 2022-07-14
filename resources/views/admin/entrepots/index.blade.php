@extends('admin.partials.main')

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
                
                 <a href="{{ route('stock.entrepots.create') }}"><button class="btn btn-lg btn-primary ladda-button basic-ladda-button" style="float: right"  data-style="expand-right"><span class="ladda-label">Ajouter un entrepôt</span></button></a>
                
                <div class="table-responsive">
                    <table class="display table table-striped table-bordered table_oholiab"  style="width:100%">
                        <thead>
                            <tr>
                                <th>Libéllé</th>
                                <th>Entreprise</th>
                                <th>Lieu</th>
                                <th>Date de création</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($entrepots as $entrepot)
                                <tr class="tr-link" data-link="{{ route('admin.entrepots.show',$entrepot) }}">
                                    <td>{{ $entrepot->name }}</td>
                                    <td class="text-center">{!! $entrepot->entreprise ? '<img class="py-2" style="height:3.5rem;" src="'.asset($entrepot->entreprise->logo).'" alt="logo" />' : ''  !!}</td>
                                    <td>{{ $entrepot->lieu }}</td>
                                    <td>{{ ucwords((new Carbon\Carbon($entrepot->created_at))->locale('fr')->isoFormat('DD/MM/YYYY')) }}</td>
                                </tr>
                            @empty
                                
                            @endforelse
                            

                        </tbody>
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