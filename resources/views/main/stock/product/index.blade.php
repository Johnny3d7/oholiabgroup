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
                        {{-- <table class="display table table-striped table-bordered table_oholiab"  style="width:100%">
                            <thead>
                                <tr>
                                    <th>Référence</th>
                                    <th>Libéllé</th>
                                    <th>Catégorie</th>
                                    <th>Nature</th>
                                    <th>Type</th>
                                    <th>Date d'ajout</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($products as $product)
                                    <tr>
                                        <td>{{ $product->reference }}</td>
                                        <td>{{ $product->name }}</td>
                                        <td>{{ $product->category->name }}</td>
                                        <td>{{ $product->nature }}</td>
                                        <td>{{ $product->type }}</td>
                                        <td>{{ ucwords((new Carbon\Carbon($product->created_at))->locale('fr')->isoFormat('DD/MM/YYYY')) }}</td>
                                        <td>
                                            <a href="{{ route('stock.products.show', $product) }}">
                                                <button class="btn btn-outline-warning btn-icon m-1" type="button">
                                                    <span class="ul-btn__icon"><i class="i-Eye"></i></span>
                                                </button>
                                            </a>
                                            <a href="{{ route('stock.products.edit', $product) }}">
                                                <button class="btn btn-outline-success btn-icon m-1" type="button">
                                                    <span class="ul-btn__icon"><i class="i-Edit"></i></span>
                                                </button>
                                            </a>
                                            <a href="{{ route('stock.products.destroy', $product) }}">
                                                <button class="btn btn-outline-danger btn-icon m-1" type="button">
                                                    <span class="ul-btn__icon"><i class="i-Close"></i></span>
                                                </button>
                                            </a>
                                        </td>
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
                        </table> --}}
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
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($products as $product)
                                    <tr>
                                        <td>{{ $product->reference }}</td>
                                        <td class="text-center"><img class="py-2" style="height:5rem;" src="{{ asset($product->image()) }}" alt="" /></td>
                                        <td>{{ $product->name }}</td>
                                        <td>{{ $product->category->name }}</td>
                                        <td>{{ $product->nature }}</td>
                                        <td>{{ $product->type }}</td>
                                        <td>{{ ucwords((new Carbon\Carbon($product->created_at))->locale('fr')->isoFormat('DD/MM/YYYY')) }}</td>
                                        <td>
                                            <a href="{{ route('stock.products.show', $product) }}">
                                                <button class="btn btn-outline-warning btn-icon m-1" type="button">
                                                    <span class="ul-btn__icon"><i class="i-Eye"></i></span>
                                                </button>
                                            </a>
                                            <a href="{{ route('stock.products.edit', $product) }}">
                                                <button class="btn btn-outline-success btn-icon m-1" type="button">
                                                    <span class="ul-btn__icon"><i class="i-Edit"></i></span>
                                                </button>
                                            </a>
                                            <a href="{{ route('stock.products.destroy', $product) }}">
                                                <button class="btn btn-outline-danger btn-icon m-1" type="button">
                                                    <span class="ul-btn__icon"><i class="i-Close"></i></span>
                                                </button>
                                            </a>
                                        </td>
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
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    @else
        @forelse ($products->sortBy('name') as $product)
            <div class="col-md-3 py-2">
                <a href="{{ route('stock.products.show', $product) }}">
                    <div class="card">
                        @if ($product->image)
                            <img class="d-block w-100 rounded rounded" src="{{ asset($product->image) }}" alt="alt" />
                        @else
                            <img class="d-block w-100 rounded rounded" src="{{ url('images/product_picture.jpg') }}" alt="alt" />
                        @endif
                        {{-- <img class="d-block w-100 rounded rounded" src="../../dist-assets/images/products/iphone-1.jpg" alt="First slide"> --}}
                        <div class="card-body">
                            <h5 class="card-title mb-2">{{ $product->name }}</h5>
                            <p class="card-text text-mute">{{ $product->category->name }} - {{ $product->nature }}</p>
                            <span class="rounded" style="position: absolute; top:1rem; right: 0rem; background-color: rgba(218, 201, 201, 0.5)"><img class="m-2" src="{{ asset($product->entreprise->logo) }}" alt="" style="height: 4rem;"></span>
                            {{-- <a href="{{ route('stock.products.show', $product) }}" class="btn btn-primary ul-btn-raised--v2 m-1" type="button">
                                <span class="ul-btn__icon"><i class="i-Eye"></i></span> Consulter
                            </a>
                            <a href="{{ route('stock.products.edit', $product) }}" class="btn btn-outline-success ul-btn-raised--v2 m-1 float-right" type="button">
                                <span class="ul-btn__icon"><i class="i-Edit"></i></span> Modifier
                            </a> --}}
                        </div>
                    </div>
                </a>
            </div>
        @empty
            Nothing yet ...
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