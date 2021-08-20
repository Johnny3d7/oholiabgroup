@extends('main.layout.main')

@section('stylesheets')

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
                
                {{--  <a href="{{ route('stock.product.create') }}">--}}<button class="btn btn-lg btn-primary" data-toggle="modal" data-target="#addproduct" data-whatever="@fat" style="float: right" data-style="expand-right"><span class="ladda-label">Ajouter un produit</span></button>{{--</a>--}}
                <div class="modal fade" id="addproduct" tabindex="-1" role="dialog" aria-labelledby="addproduct" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="addproduct_title">Ajout d'un nouveau produit</h5>
                                <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                            </div>
                            <div class="modal-body">
                                <form method="post" action="{{ route('stock.product.store')}}">
                                    @csrf
                                    @method('POST')
                                    <div class="form-group ">
                                        <label class="col-form-label" for="lib">Libellé du produit:</label>
                                        <input class="form-control" id="lib" type="text" name="lib" required/>
                                    </div>
                                    <div class="form-group ">
                                        <label class="col-form-label" for="slug_product_category">Catégorie produit:</label>
                                        <select name="slug_product_category" class="form-control" required>
                                            @forelse (ProductCategory::where('status', 1)->orderBy('lib', 'asc')->get() as $data)
                                                <option value="{{ $data->slug }}" @if (old('slug_product_category')== '{{ $data->slug }}') selected="selected" @endif>{{ $data->lib }}</option>
                                            @empty
                                                
                                            @endforelse
                                        </select>
                                    </div>
                                    <div class="form-group ">
                                        <label class="col-form-label" for="price">Prix unitaire:</label>
                                        <input class="form-control" id="price" type="text" name="price" required/>
                                    </div>
                                    <div class="form-group ">
                                        <label class="col-form-label" for="unite">Unité de mesure:</label>
                                        <select name="unite" class="form-control" id="unite" required>
                                                <option value="simple" @if (old('unite')=='simple') selected="selected" @endif>Simple</option>
                                                <option value="Kg" @if (old('unite')=='kg') selected="selected" @endif>Kilogramme (Kg)</option>
                                                <option value="g" @if (old('unite')=='g') selected="selected" @endif>Gramme (g)</option>
                                                <option value="m" @if (old('unite')=='m') selected="selected" @endif>Mètre (m)</option>
                                                <option value="cm" @if (old('unite')=='cm') selected="selected" @endif>Centimètre (cm)</option>
                                                <option value="A" @if (old('unite')=='A') selected="selected" @endif>Ampère (A)</option>
                                                <option value="m3" @if (old('unite')=='m3') selected="selected" @endif>Volume (m<sup>3</sup>)</option>
                                                <option value="L" @if (old('unite')=='L') selected="selected" @endif>Litre (L)</option>
                                                <option value="ml" @if (old('unite')=='ml') selected="selected" @endif>Mililitre (ml)</option>
                                        </select>
                                    </div>
                                    <div class="form-group ">
                                        <label class="col-form-label" for="stockalert">Stock alerte:</label>
                                        <input class="form-control" id="stockalert" type="text" name="stockalert" required/>
                                    </div>
                                    <div class="modal-footer">
                                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Fermer</button>
                                        <button class="btn btn-primary" type="submit">Valider</button>
                                    </div>
                                </form>
                                
                            </div>
                            
                        </div>
                    </div>
                </div>
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
                                    <td><button class="btn btn-outline-danger btn-icon m-1" type="button"><span class="ul-btn__icon"><i class="i-Shutter"></i></span></button><button class="btn btn-outline-success m-1" type="button" data-toggle="modal" data-target="#verifyModalContent{{ $data->id }}" data-whatever="@fat">Modifier</button><a href="{{ route('stock.product.destroy',['slug'=>$data->slug]) }}"><button class="btn btn-outline-danger m-1" type="button">Supprimer</button></a></td>
                                </tr>
                                <div class="modal fade" id="verifyModalContent{{ $data->id }}" tabindex="-1" role="dialog" aria-labelledby="verifyModalContent{{ $data->id }}" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="verifyModalContent{{ $data->id }}_title">Modification du produit {{ $data->lib }}</h5>
                                                <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                            </div>
                                            <div class="modal-body">
                                                <form method="put" action="{{ route('stock.product.update', ['slug'=>$data->slug])}}">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="form-group ">
                                                        <label class="col-form-label" for="lib">Libellé du produit:</label>
                                                        <input class="form-control" id="lib" type="text" value="{{ $data->lib }}" name="lib" required/>
                                                    </div>
                                                    <div class="form-group ">
                                                        <label class="col-form-label" for="id_product_category">Catégorie produit:</label>
                                                        <select name="id_product_category" class="form-control" required>
                                                            @forelse (ProductCategory::where('status', 1)->orderBy('lib', 'asc')->get() as $cat)
                                                                @if ($data->productCategory->id == $cat->id)
                                                                <option value="{{ $cat->slug }}" selected>{{ $cat->lib }}</option>
                                                                @else
                                                                <option value="{{ $cat->slug }}">{{ $cat->lib }}</option>
                                                                @endif
                                                                
                                                            @empty
                                                                
                                                            @endforelse
                                                        </select>
                                                    </div>
                                                    <div class="form-group ">
                                                        <label class="col-form-label" for="id_type_product">Type produit:</label>
                                                        <select name="id_type_product" class="form-control" required>
                                                            @forelse (TypeProduct::where('status', 1)->orderBy('lib', 'asc')->get() as $type)
                                                                @if ($data->typeProduct->id == $type->id)
                                                                <option value="{{ $type->id }}" selected>{{ $type->lib }}</option>
                                                                @else
                                                                <option value="{{ $type->id }}">{{ $type->lib }}</option>
                                                                @endif
                                                                
                                                            @empty
                                                                
                                                            @endforelse
                                                        </select>
                                                    </div>
                                                    <div class="form-group ">
                                                        <label class="col-form-label" for="price">Prix unitaire:</label>
                                                        <input class="form-control" id="price" type="text" name="price" value="{{ $data->price }}" required/>
                                                    </div>
                                                    <div class="form-group ">
                                                        <label class="col-form-label" for="stockalert">Stock alerte:</label>
                                                        <input class="form-control" id="stockalert" type="text" name="stockalert" value="{{ $data->stockalert }}" required/>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Fermer</button>
                                                        <button class="btn btn-primary" type="submit">Valider</button>
                                                    </div>
                                                </form>
                                                
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>
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