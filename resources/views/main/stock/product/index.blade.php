@extends('main.stock.partials.main')

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
                    <table class="display table table-striped table-bordered" id="productsTable" style="width:100%">
                        <thead>
                            <tr>
                                <th>Référence</th>
                                <th>Libéllé</th>
                                <th>Catégorie</th>
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
                                    <td>{{ $data->stockalert }}</td>
                                    <td>{{ $data->typeProduct->lib }}</td>
                                    <td>{{ ucwords((new Carbon\Carbon($data->created_at))->locale('fr')->isoFormat('DD/MM/YYYY')) }}</td>
                                    <td><a href="{{ route('stock.product.show',['slug'=>$data->slug]) }}"><button class="btn btn-outline-warning btn-icon m-1" type="button"><span class="ul-btn__icon"><i class="i-Eye"></i></span></button></a><a href="{{ route('stock.product.edit',['slug'=>$data->slug]) }}"><button class="btn btn-outline-success btn-icon m-1" type="button"><span class="ul-btn__icon"><i class="i-Edit"></i></span></button></a><a href="{{ route('stock.product.destroy',['slug'=>$data->slug]) }}"><button class="btn btn-outline-danger btn-icon m-1" type="button"><span class="ul-btn__icon"><i class="i-Close"></i></span></button></a></td>
                                </tr>
                            @empty
                                
                            @endforelse
                            

                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Référence</th>
                                <th>Libéllé</th>
                                <th>Catégorie</th>
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
<script>
    $(document).ready(function() {
    $('#productsTable').DataTable({
        "order": [[ 1, "asc" ]],
        paging: true,
        searching: true,
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    } );
} );
</script>
@endsection