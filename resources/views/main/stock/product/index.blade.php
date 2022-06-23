@extends('main.stock.partials.main')

@section('title', 'Liste produits -')
    
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
    @if (isset($view) && $view == "list")
        <div class="col-md-12 mb-4">
            <div class="card text-left">
                
                <div class="card-body">
                    <a href="{{ route('stock.products.create') }}">
                        <button class="btn btn-lg btn-primary ladda-button basic-ladda-button" style="float: right"  data-style="expand-right">
                            <span class="ladda-label">Ajouter un produit</span>
                        </button>
                    </a>
                    <div class="table-responsive">
                        <table class="display table table-striped table-bordered table_oholiab" data-to-export="[0,2,3,4,5,6]" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Référence</th>
                                    <th>Image</th>
                                    <th>Libéllé</th>
                                    <th>Catégorie</th>
                                    <th>Nature</th>
                                    <th>Type</th>
                                    <th>Date d'ajout</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($products as $product)
                                    <tr class="tr-link" data-link="{{ route('stock.products.show', $product) }}">
                                        <td>{{ $product->reference }}</td>
                                        <td class="text-center"><img class="py-2" style="height:5rem;" src="{{ asset($product->image()) }}" alt="" /></td>
                                        <td>{{ $product->name }}</td>
                                        <td>{{ $product->category->name }}</td>
                                        <td>{{ $product->nature }}</td>
                                        <td>{{ $product->type }}</td>
                                        <td>{{ ucwords((new Carbon\Carbon($product->created_at))->locale('fr')->isoFormat('DD/MM/YYYY')) }}</td>
                                    </tr>
                                @empty
                                    
                                @endforelse
                                
    
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Référence</th>
                                    <th>Image</th>
                                    <th>Libéllé</th>
                                    <th>Catégorie</th>
                                    <th>Stock alerte</th>
                                    <th>Unité (Mesure)</th>
                                    <th>Date d'ajout</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    @else
        @forelse ($products->sortBy('id_entreprises') as $product)
            <div class="col-lg-3 col-md-4 py-2">
                <a href="{{ route('stock.products.show', $product) }}">
                    <div class="card">
                        <img class="d-block w-100 rounded rounded" src="{{ asset($product->image()) }}" alt="alt" />
                        <div class="card-body">
                            <h5 class="card-title mb-2 text-truncate" title="{{ $product->name }}">{{ $product->name }}</h5>
                            <p class="card-text text-mute">{{ $product->category->name }} - {{ $product->nature }}</p>
                            <span class="rounded" style="position: absolute; top:1rem; right: 0rem; background-color: rgba(218, 201, 201, 0.5)"><img class="m-2" src="{{ asset($product->entreprise->logo) }}" alt="" style="height: 3rem;"></span>
                        </div>
                    </div>
                </a>
            </div>
        @empty
            <h6 class="text-center">Aucun produit !</h6>
        @endforelse
        
    @endif
</div>
@endsection

@section('javascripts')
<script>
//     $(document).ready(function() {
//     $('#productsTable').DataTable({
//         "order": [[ 1, "asc" ]],
//         paging: true,
//         "language": {
//                 "url": "{{ url('js/language/french_json.json')}}",
//         searching: true,
//         dom: 'Bfrtip',
//         buttons: [
//             'copy', 'csv', 'excel', 'pdf', 'print'
//         ]
//     } );
// } );
</script>
@endsection