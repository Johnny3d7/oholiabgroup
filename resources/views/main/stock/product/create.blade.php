@extends('main.stock.partials.main')

@section('title', 'Ajout produit -')

@section('stylesheets')

@endsection

@section('menuTitle')
Produit
@endsection

@section('pageTitle')
Ajouter un produit
@endsection

@section('content')
<div class="row">
    <div class="container-fluid">
        <section class="ul-product-detail__box">
            <div class="row">
                    <div class="col-lg-3 col-md-3 mt-1 mb-4 text-center">
                        <a href="{{ route('stock.products.index')}}">
                        <div class="card">
                            <div class="card-body">
                                <div class="ul-product-detail__border-box">
                                    <div class="ul-product-detail--icon mb-2"><i class="i-Check text-success text-25 font-weight-500"></i></div>
                                    <h5 class="heading">Liste des produits</h5>
                                    <p class="text-muted text-12">Afficher la liste de tous les produits.</p>
                                </div>
                            </div>
                        </div>
                    </a>
                    </div>
            </div>
        </section>
        {{-- <div class="card animate__animated animate__backInDown">
            <div class="card-header bg-transparent">
            <h3 class="card-title">Ajout d'un nouveau produit</h3>
            </div>
            <!-- begin::form-->
            <form method="post" action="{{ route('stock.products.store')}}" enctype="multipart/form-data">
                @csrf
                @method('POST')
                <div class="card-body">    
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label class="ul-form__label" for="lib">Libellé produit:</label>
                            <input class="form-control" value="{{ old('lib') }}" name="lib" id="lib" type="text" placeholder="Ex: Papier rame" required/>
                            <small class="ul-form__text form-text" id="">
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
                                <option value=""  selected>-- Sélectionner --</option>
                                @forelse (Category::all() as $data)
                                    <option value="{{ $data->id }}" @if (old('id_product_category')== '{{ $data->id }}') selected="selected" @endif>{{ $data->name }}</option>
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
                                    <option value="{{ $data->id }}" @if (old('id_type_product')== '{{ $data->id }}') selected="selected" @endif>{{ $data->lib }}</option>
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
                            <input class="form-control" value="{{ old('price') }}" name="price" id="price" type="text" placeholder="Ex: 7250"/><small class="ul-form__text form-text" id="">
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
                            <input class="form-control" value="{{ old('stockalert') }}" name="stockalert" id="stockalert" type="number" placeholder="Ex: 815" required/><small class="ul-form__text form-text" id="">
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
                            <input class="form-control" value="{{ old('poids') }}" name="poids" id="poids" type="number" placeholder="Ex: 150"/><small class="ul-form__text form-text" id="passwordHelpBlock">
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
                                <option value="T" @if (old('unite_poids')=='T') selected="selected" @endif>Tonne (T)</option>
                                <option value="Kg" @if (old('unite_poids')=='Kg') selected="selected" @endif>Kilogramme (Kg)</option>
                                <option value="g" @if (old('unite_poids')=='g') selected="selected" @endif>Gramme (g)</option>
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
                            <input class="form-control" value="{{ old('dimension') }}" name="dimension" id="dimension" type="text" placeholder="Ex: 85 x 4 x 478" data-inputmask='"mask": "9{*}x9{*}x9{*}"' data-mask/><small class="ul-form__text form-text" id="">
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
                                <option value="m" @if (old('unite_mesure')=='m') selected="selected" @endif>Mètre (m)</option>
                                <option value="cm" @if (old('unite_mesure')=='cm') selected="selected" @endif>Centimètre (cm)</option>
                                <option value="mm" @if (old('unite_mesure')=='mm') selected="selected" @endif>Millimètre (mm)</option>
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
                            <input class="form-control" value="{{ old('volume') }}" name="volume" id="volume" type="number" placeholder="Ex: 150"/><small class="ul-form__text form-text" id="">
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
                                <option value="m3" @if (old('unite_volume')=='m3') selected="selected" @endif>Mètre cube (m3)</option>
                                <option value="l" @if (old('unite_volume')=='l') selected="selected" @endif>Litre (l)</option>
                                <option value="cl" @if (old('unite_volume')=='cl') selected="selected" @endif>Centilitre (cl)</option>
                            </select><small class="ul-form__text form-text" id="">
                                Choisissez l'unité svp!
                            </small>
                            @if ($errors->has('unite_volume'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('unite_volume') }}
                                </div>
                            @endif
                        </div>
                        
                    </div>
                    <div class="custom-separator"></div>
                    <div class="form-group col-md-4">
                        <label class="col-form-label" for="qte">Image (.png | .jpg | .jpeg): </label>               
                        <div class="custom-file">
                            <input class="custom-file-input" id="inputGroupFile01" type="file" name="image" aria-describedby="inputGroupFileAddon01" />
                            <label class="custom-file-label" for="inputGroupFile01">Choisir une image </label>
                        </div>
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
        </div> --}}

        <div class="card animate__animated animate__backInDown">
            <div class="card-header bg-transparent">
            <h3 class="card-title">Ajout d'un nouveau produit</h3>
            </div>
            <!-- begin::form-->
            <form method="post" action="{{ route('stock.products.store')}}" enctype="multipart/form-data">
                @csrf
                @method('POST')
                <div class="card-body">    
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label class="ul-form__label" for="name">Nom produit:</label>
                            <input class="form-control" value="{{ old('name') }}" name="name" id="name" type="text" placeholder="Ex: Papier rame" required/>
                            <small class="ul-form__text form-text" id="">
                                Entrez le nom du produit svp!
                            </small>
                            @if ($errors->has('name'))
                                <div class="alert-danger p-2 rounded">
                                    {{ $errors->first('name') }}
                                </div>
                            @endif
                        </div>
                        <div class="form-group col-md-4">
                            <label class="ul-form__label" for="id_categories">Catégorie produit:</label>
                            <select name="id_categories" id="id_categories" class="form-control" required>
                                <option value="" selected>-- Sélectionner --</option>
                                @forelse ($categories as $category)
                                    <option value="{{ $category->id }}" @if (old('id_categories') == $category->id) selected="selected" @endif>{{ $category->name }}</option>
                                @empty
                                    
                                @endforelse
                            </select><small class="ul-form__text form-text" id="">
                                Choisissez la catégorie du produit svp!
                            </small>
                            @if ($errors->has('id_categories'))
                                <div class="alert-danger p-2 rounded">
                                    {{ $errors->first('id_categories') }}
                                </div>
                            @endif
                        </div>
                        <div class="form-group col-md-4">
                            <label class="ul-form__label" for="type">Type produit:</label>
                            <select id="type" name="type" class="form-control" required>
                                <option value=""  selected>-- Sélectionner --</option>
                                @php $types = ["Périssable", "Fragile"] ;@endphp
                                @forelse ($types as $type)
                                    <option value="{{ $type }}" @if (old('type') == $type) selected="selected" @endif>{{ $type }}</option>
                                @empty
                                    
                                @endforelse
                            </select>
                            <small class="ul-form__text form-text" id="">
                                Choisissez le type du produit svp!
                            </small>
                            @if ($errors->has('type'))
                                <div class="alert-danger p-2 rounded">
                                    {{ $errors->first('type') }}
                                </div>
                            @endif
                        </div>
                        <div class="form-group col-md-4">
                            <label class="ul-form__label" for="nature">Nature produit:</label>
                            <select id="nature" name="nature" class="form-control" required>
                                <option value=""  selected>-- Sélectionner --</option>
                                @php $natures = ["Pack", "Unité"] ;@endphp
                                @forelse ($natures as $nature)
                                    <option value="{{ $nature }}" @if (old('nature') == $nature) selected="selected" @endif>{{ $nature }}</option>
                                @empty
                                    
                                @endforelse
                            </select>
                            <small class="ul-form__text form-text" id="">
                                Choisissez la nature du produit svp!
                            </small>
                            @if ($errors->has('nature'))
                                <div class="alert-danger p-2 rounded">
                                    {{ $errors->first('nature') }}
                                </div>
                            @endif
                        </div>
                        <div class="form-group col-md-4">
                            <label class="ul-form__label" for="unite">Unité produit:</label>
                            <select id="unite" name="unite" class="form-control" required>
                                <option value=""  selected>-- Sélectionner --</option>
                                @php $unites = ["Pack", "Unité"] ;@endphp
                                @forelse ($unites as $unite)
                                    <option value="{{ $unite }}" @if (old('unite') == $unite) selected="selected" @endif>{{ $unite }}</option>
                                @empty
                                    
                                @endforelse
                            </select>
                            <small class="ul-form__text form-text" id="">
                                Choisissez l'unité du produit svp!
                            </small>
                            @if ($errors->has('unite'))
                                <div class="alert-danger p-2 rounded">
                                    {{ $errors->first('unite') }}
                                </div>
                            @endif
                        </div>
                        <div class="form-group col-md-4">
                            <label class="ul-form__label">Entreprise de production</label>
                            <div class="">
                                @foreach ($entreprises->sortBy('name') as $entreprise)
                                    <label class="radio radio-outline-primary ml-5" style="display: inline">
                                        <input type="radio" name="id_entreprises" value="{{ $entreprise->id }}" @if (old('id_entreprises') == $entreprise->id) selected="checked" @endif>
                                        <span><img src="{{ asset($entreprise->logo) }}" alt="" style="height: 4rem;"></span>
                                        <span class="checkmark"></span>
                                    </label>
                                @endforeach
                            </div>
                            @if ($errors->has('id_entreprises'))
                                <div class="alert-danger p-2 rounded">
                                    {{ $errors->first('id_entreprises') }}
                                </div>
                            @endif
                        </div>
                        
                    </div>
                    <div class="custom-separator"></div>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label class="col-form-label" for="image">Image (.png | .jpg | .jpeg): </label>               
                            <input type="file" name="image" class="dropify" data-bs-height="180" accept=".png, .jpg, .jpeg" />
                        </div>
                        <div class="form-group col-md-8">
                            <label class="col-form-label" for="description">Description: </label>               
                            <textarea class="form-control" name="description" id="description" cols="30" rows="5" placeholder="Veuillez donner une description du produit (Ce champs est facultatif)">@if (old('description')) {{ old('description') }} @endif</textarea>
                        </div>
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