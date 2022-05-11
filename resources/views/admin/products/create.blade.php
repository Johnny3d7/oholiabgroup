@extends(\Auth::user()->hasRole('admin') ? 'admin.partials.main' : 'main.stock.partials.main')
{{-- @extends('main.stock.partials.main') --}}

@section('raccourcis')
    @include('admin.products._header')
@endsection

@section('stylesheets')
    {{-- <link rel="stylesheet" href="{{ asset('myplugins/fileuploads/css/fileupload.css') }}" /> --}}
    <link rel="stylesheet" href="{{ asset('myplugins/dropify/css/dropify.css') }}" />
@endsection

@section('menuTitle')
Produits
@endsection

@section('pageTitle')
Produits
@endsection

@section('content')
<div class="row">
    <div class="container-fluid">
        @role('admin')
        <section class="ul-product-detail__box">
            <div class="row">
                {{-- <div class="col-lg-3 col-md-3 mt-1 mb-4 text-center">
                    <a href="{{ route('admin.products.index')}}">
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
                </div> --}}
                <div class="col-lg-3 col-md-3 mt-1 mb-4 text-center">
                    <a href="{{ route('admin.products.index')}}">
                        <div class="card">
                            <div class="card-body">
                                <div class="ul-product-detail__border-box">
                                    <div class="ul-product-detail--icon mb-2"><i class="i-Folder-Settings text-success text-25 font-weight-500"></i></div>
                                    <h5 class="heading">Gérer les catégories</h5>
                                    <p class="text-muted text-12">Ajouter / Modifier / Supprimer les catégories de produit.</p>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-3 col-md-3 mt-1 mb-4 text-center">
                    <a href="{{ route('admin.products.index')}}">
                        <div class="card">
                            <div class="card-body">
                                <div class="ul-product-detail__border-box">
                                    <div class="ul-product-detail--icon mb-2"><i class="i-Gear text-success text-25 font-weight-500"></i></div>
                                    <h5 class="heading">Gérer les types</h5>
                                    <p class="text-muted text-12">Ajouter / Modifier / Supprimer les types de produit.</p>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-3 col-md-3 mt-1 mb-4 text-center">
                    <a href="{{ route('admin.products.index')}}">
                        <div class="card">
                            <div class="card-body">
                                <div class="ul-product-detail__border-box">
                                    <div class="ul-product-detail--icon mb-2"><i class="i-Gear-2 text-success text-25 font-weight-500"></i></div>
                                    <h5 class="heading">Gérer les natures</h5>
                                    <p class="text-muted text-12">Ajouter / Modifier / Supprimer les natures de produit.</p>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-3 col-md-3 mt-1 mb-4 text-center">
                    <a href="{{ route('admin.products.index')}}">
                        <div class="card">
                            <div class="card-body">
                                <div class="ul-product-detail__border-box">
                                    <div class="ul-product-detail--icon mb-2"><i class="i-Data-Settings text-success text-25 font-weight-500"></i></div>
                                    <h5 class="heading">Gérer les unités</h5>
                                    <p class="text-muted text-12">Ajouter / Modifier / Supprimer les unités de produit.</p>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </section>
        @endrole
        <div class="card animate__animated animate__backInDown">
            <div class="card-header bg-transparent">
            <h3 class="card-title">Ajout d'un nouveau produit</h3>
            </div>
            <!-- begin::form-->
            <form method="post" action="{{ route('admin.products.store')}}" enctype="multipart/form-data">
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
                                @php $natures = ["Unité", "Pack", "Carton", "Lot"] ;@endphp
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
                                @php $unites = ["Unité", "Kilogramme", "Litre"] ;@endphp
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
                            <input type="file" name="image" class="dropify-fr" data-bs-height="180" accept=".png, .jpg, .jpeg" />
                        </div>
                        <div class="form-group col-md-8">
                            <label class="col-form-label" for="description">Description: </label>               
                            <textarea class="form-control" name="description" id="description" cols="30" rows="9" placeholder="Veuillez donner une description du produit (Ce champs est facultatif)">@if (old('description')) {{ old('description') }} @endif</textarea>
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
    {{-- <script src="{{ asset('myplugins/fileuploads/js/fileupload.js') }}"></script> --}}
    <script src="{{ asset('myplugins/dropify/js/dropify.js') }}"></script>
    <script>
        // $('.dropify').dropify({
        //     messages: {
        //         'default': 'Glisser-déposer une image ou cliquer pour parcourir', //'Drag and drop a file here or click',
        //         'replace': 'Glisser-déposer une image ou cliquer pour remplacer', //'Drag and drop or click to replace',
        //         'remove': '<i class="i-Remove text-20"></i>', //'Remove',
        //         'error': 'Oups, Une erreur est survenue', //'Ooops, something wrong appended.'
        //     },
        //     error: {
        //         'fileSize': 'Le fichier choisi est beaucoup trop volumineux (Max : 2 Mo)', //'The file size is too big (2M max).'
        //     }
        // });
        // Basic
        $('.dropify').dropify();

        // Translated
        $('.dropify-fr').dropify({
            messages: {
                default: 'Glissez-déposez un fichier ici ou cliquez',
                replace: 'Glissez-déposez un fichier ou cliquez pour remplacer',
                remove:  'Supprimer <i class="i-Remove"></i>',
                error:   'Désolé, le fichier trop volumineux'
            }
        });
    </script>
    <!-- End Dropify -->
    
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