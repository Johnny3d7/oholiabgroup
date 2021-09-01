@extends('main.layout.main')

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
Produit
@endsection

@section('pageTitle')
Liste des produits
@endsection

@section('content')
<div class="row mb-4">
    <div class="col-md-12 mb-4">
        <div class="card text-left">
            
            <div class="card-body">
                
                 <a href="{{ route('stock.product.create') }}"><button class="btn btn-lg btn-primary ladda-button basic-ladda-button" style="float: right"  data-style="expand-right"><span class="ladda-label">Ajouter un produit</span></button></a>
                
                <div class="table-responsive">
                    <table class="display table table-striped table-bordered" id="zero_configuration_table" style="width:100%">
                        <thead>
                            <tr>
                                <th>Référence</th>
                                <th>Libéllé</th>
                                <th>Catégorie</th>
                                <th>Prix unitaire</th>
                                <th>Stock alerte</th>
                                <th>Type du produit</th>
                                <th>Date d'ajout</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($products as $data)
                                <tr>
                                    <td>{{ $data->ref }}</td>
                                    <td>{{ $data->lib }}</td>
                                    <td>{{ $data->productCategory->lib }}</td>
                                    <td>{{ number_format($data->price , 0, '', ' ') }} FCFA</td>
                                    <td>{{ $data->stockalert }}</td>
                                    <td>{{ $data->typeProduct->lib }}</td>
                                    <td>{{ ucwords((new Carbon\Carbon($data->created_at))->locale('fr')->isoFormat('DD/MM/YYYY')) }}</td>
                                    <td><a href="{{ route('stock.product.show',['slug'=>$data->slug]) }}"><button class="btn btn-outline-warning btn-icon m-1" type="button"><span class="ul-btn__icon"><i class="i-Eye"></i></span></button></a><a href="{{ route('stock.product.edit',['slug'=>$data->slug]) }}"><button class="btn btn-outline-success m-1" type="button">Modifier</button></a><a href="{{ route('stock.product.destroy',['slug'=>$data->slug]) }}"><button class="btn btn-outline-danger m-1" type="button">Supprimer</button></a></td>
                                </tr>
                            @empty
                                
                            @endforelse
                            

                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Référence</th>
                                <th>Libéllé</th>
                                <th>Catégorie</th>
                                <th>Prix unitaire</th>
                                <th>Stock alerte</th>
                                <th>Unité (Mesure)</th>
                                <th>Date d'ajout</th>
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

@endsection