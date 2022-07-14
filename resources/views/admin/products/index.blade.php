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
                <a href="{{ route('admin.products.create') }}">
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
                                <tr class="tr-link" data-link="{{ route('admin.products.show',$product) }}">
                                    <td>{{ $product->reference }}</td>
                                    <td class="text-center"><img class="py-2" style="height:5rem;" src="{{ asset($product->image()) }}" alt="" /></td>
                                    <td>{{ $product->name }}</td>
                                    <td>{{ $product->category->name }}</td>
                                    <td>{{ $product->parametre('nature')->name }}</td>
                                    <td>{{ $product->parametre('type')->name }}</td>
                                    <td>{{ ucwords((new Carbon\Carbon($product->created_at))->locale('fr')->isoFormat('DD/MM/YYYY')) }}</td>
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

@endsection