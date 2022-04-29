@extends('admin.partials.main')

@section('raccourcis')
    @include('admin.products._header')
@endsection

@section('stylesheets')

@endsection

@section('menuTitle')
Produits
@endsection

@section('pageTitle')
Produits
@endsection

@section('content')
<div class="row mb-4">
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
</div>
@endsection

@section('javascripts')

@endsection