@extends('main.stock.partials.main')

@section('stylesheets')

@endsection

@section('menuTitle')
Produit
@endsection

@section('pageTitle')
Modifier produit
@endsection

@section('content')
<div class="row">
    <div class="col-md-10">
       
        
        <div class="card animate__animated animate__backInDown">
            <div class="card-header bg-transparent">
            <h3 class="card-title">Modifier le produit</h3>
            </div>
            <!-- begin::form-->
            <form method="put" action="{{ route('stock.product.update', ['slug'=>$product->slug])}}">
                @csrf
                @method('PUT')
                <div class="card-body">    
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label class="ul-form__label" for="lib">Libellé produit:</label>
                            <input class="form-control" value="{{ $product->lib }}" name="lib" id="lib" type="text" placeholder="Ex: Papier rame" required/><small class="ul-form__text form-text" id="">
                                Entrez le libellé du produit svp!
                            </small>
                            @if ($errors->has('lib'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('lib') }}
                                </div>
                            @endif
                        </div>
                        <div class="form-group col-md-3">
                            <label class="ul-form__label" for="id_product_category">Catégorie produit:</label>
                            <select name="id_product_category" id="id_product_category" class="form-control" required>
                                <option value="" >-- Sélectionner --</option>
                                @forelse (ProductCategory::where('status', 1)->orderBy('lib', 'asc')->get() as $data)
                                    <option value="{{ $data->id }}"  @if ($data->id == $product->id_product_category) selected="selected" @endif>{{ $data->lib }}</option>
                                @empty
                                    
                                @endforelse
                            </select><small class="ul-form__text form-text" id="">
                                Choisissez la catégorie du produit svp!
                            </small>
                            @if ($errors->has('id_product_category'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('id_product_category') }}
                                </div>
                            @endif
                        </div>
                        <div class="form-group col-md-3">
                            <label class="ul-form__label" for="id_type_product">Type produit:</label>
                            <select name="id_type_product" class="form-control" required>
                                <option value=""  selected>-- Sélectionner --</option>
                                @forelse (TypeProduct::where('status', 1)->orderBy('lib', 'asc')->get() as $data)
                                    <option value="{{ $data->id }}" @if ($data->id == $product->id_type_product) selected="selected" @endif>{{ $data->lib }}</option>
                                @empty
                                    
                                @endforelse
                            </select><small class="ul-form__text form-text" id="">
                                Choisissez le type du produit svp!
                            </small>
                            @if ($errors->has('id_type_product'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('id_type_product') }}
                                </div>
                            @endif
                        </div>
                        <div class="form-group col-md-2">
                            <label class="ul-form__label" for="price">Prix unitaire (Fcfa):</label>
                            <input class="form-control" value="{{ $product->price }}" name="price" id="price" type="text" placeholder="Ex: 7250"/><small class="ul-form__text form-text" id="">
                                Entrez le prix unitaire svp!
                            </small>
                            @if ($errors->has('stockalert'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('stockalert') }}
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="custom-separator"></div>
                    <div class="form-row">
                        <div class="form-group col-md-2">
                            <label class="ul-form__label" for="stockalert">Stock alerte:</label>
                            <input class="form-control" value="{{ $product->stockalert }}" name="stockalert" id="stockalert" type="number" placeholder="Ex: 815" required/><small class="ul-form__text form-text" id="">
                                Entrez la limite du stock svp
                            </small>
                            @if ($errors->has('stockalert'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('stockalert') }}
                                </div>
                            @endif
                        </div>
                        <div class="form-group col-md-2">
                            <label class="ul-form__label" for="poids">Poids:</label>
                            <input class="form-control" value="{{ $product->poids }}" name="poids" id="poids" type="number" placeholder="Ex: 150"/><small class="ul-form__text form-text" id="passwordHelpBlock">
                                Entrez le poids svp!
                            </small>
                            @if ($errors->has('poids'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('poids') }}
                                </div>
                            @endif
                        </div>
                        <div class="form-group col-md-3">
                            <label class="ul-form__label" for="unite_poids">Unité du poids:</label>
                            <select name="unite_poids" class="form-control" id="unite_poids">
                                <option value=""  selected>-- Sélectionner --</option>
                                <option value="T" @if ($product->unite_poids=='T') selected="selected" @endif>Tonne (T)</option>
                                <option value="Kg" @if ($product->unite_poids=='Kg') selected="selected" @endif>Kilogramme (Kg)</option>
                                <option value="g" @if ($product->unite_poids=='g') selected="selected" @endif>Gramme (g)</option>
                            </select><small class="ul-form__text form-text" id="">
                                Choisissez l'unité svp!
                            </small>
                            @if ($errors->has('unite_poids'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('unite_poids') }}
                                </div>
                            @endif
                        </div>
                        <div class="form-group col-md-3">
                            <label class="ul-form__label" for="dimension">Longueur x Largeur x Hauteur:</label>
                            <input class="form-control" value="{{$product->longueur.'x'.$product->largeur.'x'.$product->hauteur}}" name="dimension" id="dimension" type="text" placeholder="Ex: 85 x 4 x 478" data-inputmask='"mask": "9{*}x9{*}x9{*}"' data-mask/><small class="ul-form__text form-text" id="">
                                Entrez les dimensions svp!
                            </small>
                            @if ($errors->has('dimension'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('dimension') }}
                                </div>
                            @endif
                        </div>
                        <div class="form-group col-md-2">
                            <label class="ul-form__label" for="unite_mesure">Unité mesure:</label>
                            <select name="unite_mesure" class="form-control" id="unite_mesure" >
                                <option value=""  selected>-- Sélectionner --</option>
                                <option value="m" @if ($product->unite_mesure=='m') selected="selected" @endif>Mètre (m)</option>
                                <option value="cm" @if ($product->unite_mesure=='cm') selected="selected" @endif>Centimètre (cm)</option>
                                <option value="mm" @if ($product->unite_mesure=='mm') selected="selected" @endif>Millimètre (mm)</option>
                            </select><small class="ul-form__text form-text" id="">
                                Choisissez l'unité de mesure svp!
                            </small>
                            @if ($errors->has('unite_mesure'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('unite_mesure') }}
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="custom-separator"></div>
                    <div class="form-row">
                        <div class="form-group col-md-2">
                            <label class="ul-form__label" for="volume">Volume:</label>
                            <input class="form-control" value="{{ $product->volume }}" name="volume" id="volume" type="number" placeholder="Ex: 150"/><small class="ul-form__text form-text" id="">
                                Entrez le volume svp!
                            </small>
                            @if ($errors->has('volume'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('volume') }}
                                </div>
                            @endif
                        </div>
                        <div class="form-group col-md-2">
                            <label class="ul-form__label" for="unite_poids">Unité du volume:</label>
                            <select name="unite_volume" class="form-control" id="unite_volume">
                                <option value="" selected>-- Sélectionner --</option>
                                <option value="m3" @if ($product->unite_volume=='m3') selected="selected" @endif>Mètre cube (m3)</option>
                                <option value="l" @if ($product->unite_volume=='l') selected="selected" @endif>Litre (l)</option>
                                <option value="cl" @if ($product->unite_volume=='cl') selected="selected" @endif>Centilitre (cl)</option>
                            </select><small class="ul-form__text form-text" id="">
                                Choisissez l'unité svp!
                            </small>
                            @if ($errors->has('unite_volume'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('unite_volume') }}
                                </div>
                            @endif
                        </div>
                        
                        {{--<div class="form-group col-md-4">
                            <label class="ul-form__label" for="inputEmail18">User Group:</label>
                            <div class="ul-form__radio-inline">
                                <label class="ul-radio__position radio radio-primary form-check-inline">
                                    <input type="radio" name="radio" value="0" /><span class="ul-form__radio-font">Sales Person</span><span class="checkmark"></span>
                                </label>
                                <label class="ul-radio__position radio radio-primary">
                                    <input type="radio" name="radio" value="0" /><span class="ul-form__radio-font">Customer</span><span class="checkmark"></span>
                                </label>
                            </div><small class="ul-form__text form-text" id="passwordHelpBlock">
                                Please select user group
                            </small>
                        </div>  --}}
                    </div>
                    
                </div>
                <div class="card-footer">
                    <div class="mc-footer">
                        <div class="row">
                            <div class="col-lg-12 text-center">
                                <button class="btn btn-primary m-1" type="submit">Valider</button>
                                <button class="btn btn-outline-secondary m-1" type="reset">annuler</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <!--  end::form 3-->
        </div>
        <section class="ul-product-detail__box">
            <div class="row mb-3">
                    <div class="col-lg-4 col-md-4 mt-4 text-center">
                        <a href="{{ route('stock.product.show',['slug'=>$product->slug]) }}">
                        <div class="card">
                            <div class="card-body">
                                <div class="ul-product-detail__border-box">
                                    <div class="ul-product-detail--icon mb-2"><i class="i-Eye text-success text-25 font-weight-500"></i></div>
                                    <h5 class="heading">Voir ce produit</h5>
                                    <p class="text-muted text-12">Accéder au détail du produit (voir les caractéristiques).</p>
                                </div>
                            </div>
                        </div>
                    </a>
                    </div> 
                <div class="col-lg-4 col-md-4 mt-4 text-center">
                    <a href="{{ route('stock.products.index') }}">
                    <div class="card">
                        <div class="card-body">
                            <div class="ul-product-detail__border-box">
                                <div class="ul-product-detail--icon mb-2"><i class="i-Check text-info text-25 font-weight-500"></i></div>
                                <h5 class="heading">Liste des produits</h5>
                                <p class="text-muted text-12">Afficher la liste de tous les produits en base.</p>
                            </div>
                        </div>
                    </div>
                </a>
                </div>
                <div class="col-lg-4 col-md-4 mt-4 text-center">
                    <a href="#" type="button" data-toggle="modal" data-target="#add_variation{{ $product->id }}" data-whatever="@fat">
                    <div class="card">
                        <div class="card-body">
                            <div class="ul-product-detail__border-box">
                                <div class="ul-product-detail--icon mb-2"><i class="i-Rotation-390 text-success text-25 font-weight-500"></i></div>
                                <h5 class="heading">Ajouter un mouvement</h5>
                                <p class="text-muted text-12">Effectuer un mouvement de stock pour ce produit</p>
                            </div>
                        </div>
                    </div>
                    </a>
                </div>
                <div class="modal fade" id="add_variation{{ $product->id }}" tabindex="-1" role="dialog" aria-labelledby="add_variation{{ $product->id }}" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="add_variation{{ $product->id }}_title">Effectuer un mouvement de stock</h5>
                                <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                            </div>
                            <div class="modal-body">
                                <form method="post" action="{{ route('stock.variation.store', ['product'=>$product->id]) }}" enctype="multipart/form-data">
                                    @csrf
                                    @method('POST')
                                    <div class="form-group ">
                                        <label class="col-form-label" for="entreprise">Entrepôt:</label>
                                        <select name="entreprise" class="form-control" id="entreprise" required>
                                            @forelse (Entreprise::where('status', 1)->orderBy('nom', 'asc')->get() as $data)
                                                <option value="{{ $data->id }}">{{ $data->nom }}</option>
                                            @empty
                                                
                                            @endforelse
                                        </select>
                                    </div>
                                    <div class="form-group ">
                                        <label class="col-form-label" for="typemouv">Nature mouvement:</label>
                                        <select name="typemouv" class="form-control" id="typemouv" required>
                                                <option value="1">Entrée</option>
                                                <option value="0">Sortie</option>
                                        </select>
                                    </div>
                                    <div class="form-group ">
                                        <label class="col-form-label" for="qte">Quantité mouvement:</label>
                                        <input class="form-control" id="qte" type="text" name="qte" required/>
                                    </div>
                                    <div class="form-group ">
                                        <label class="col-form-label" for="datemouv">Date mouvement:</label>
                                        <input class="form-control" id="datemouv" type="text" name="datemouv" data-inputmask='"mask": "99-99-9999"' data-mask required/>
                                    </div>
                                    <div class="form-group ">
                                        <label class="col-form-label" for="observation">Observation:</label>
                                        <textarea name="observation" id="observation" class="form-control"></textarea>
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
            </div>
        </section>
    </div>
</div>
@endsection

@section('javascripts')
<script src="https://cdn.jsdelivr.net/npm/places.js@1.19.0"></script>
<script src="https://cdn.jsdelivr.net/npm/places.js@1.19.0/dist/cdn/placesAutocompleteDataset.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/places.js@1.19.0/dist/cdn/placesInstantsearchWidget.min.js"></script>
<script>
    var placesAutocomplete = places({
    appId: 'plYHYZFG2EIV',
    apiKey: '58ba156fd3af6b2f31fc7eb07360245a',
    container: document.querySelector('#addr')
    });
</script>
<script type="text/javascript">
    $(function () {
        $('#datetimepicker4').datetimepicker();
    });
 </script>
@endsection