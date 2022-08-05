{{-- @extends('admin.partials.main') --}}
@extends(Auth::user()->hasRole(config('constants.roles.admin')) ? 'admin.partials.main' : 'main.achats.partials.main')

@section('raccourcis')
    @include('admin.fournisseurs._header')
@endsection

@section('stylesheets')
    {{-- <link rel="stylesheet" href="{{ asset('myplugins/fileuploads/css/fileupload.css') }}" /> --}}
    <link rel="stylesheet" href="{{ asset('myplugins/dropify/css/dropify.css') }}" />
@endsection

@section('menuTitle')
Fournisseurs
@endsection

@section('pageTitle')
Fournisseurs
@endsection

@section('content')
<div class="row">
    <div class="container-fluid">
        @role(config('constants.roles.admin'))
        <section class="ul-product-detail__box">
            <div class="row">
                <div class="col-lg-3 col-md-3 mt-1 mb-4 text-center">
                    <a href="{{ route('admin.fournisseurs.index')}}">
                        <div class="card">
                            <div class="card-body">
                                <div class="ul-product-detail__border-box">
                                    <div class="ul-product-detail--icon mb-2"><i class="i-Truck text-success text-25 font-weight-500"></i></div>
                                    <h5 class="heading">Liste des fournisseurs</h5>
                                    <p class="text-muted text-12">Liste complète de tous les fournisseur.</p>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-3 col-md-3 mt-1 mb-4 text-center">
                    <a href="{{ route('admin.fournisseurs.types.index')}}">
                        <div class="card">
                            <div class="card-body">
                                <div class="ul-product-detail__border-box">
                                    <div class="ul-product-detail--icon mb-2"><i class="i-Gear text-success text-25 font-weight-500"></i></div>
                                    <h5 class="heading">Gérer les types</h5>
                                    <p class="text-muted text-12">Ajouter / Modifier / Supprimer les types de fournisseur.</p>
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
            <h3 class="card-title">Ajout d'un nouveau fournisseur</h3>
            </div>
            <!-- begin::form-->
            <form method="post" action="{{ route('admin.fournisseurs.store')}}" enctype="multipart/form-data">
                @csrf
                @method('POST')
                <div class="card-body">
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label class="ul-form__label" for="name">Nom:</label>
                            <input class="form-control" value="{{ old('name') }}" name="name" id="name" type="text" placeholder="Ex: Company name" required/>
                            <small class="ul-form__text form-text" id="">
                                Entrez le nom du fournisseur svp!
                            </small>
                            @if ($errors->has('name'))
                                <div class="alert-danger p-2 rounded">
                                    {{ $errors->first('name') }}
                                </div>
                            @endif
                        </div>
                        <div class="form-group col-md-4">
                            <label class="ul-form__label" for="contact">Contact:</label>
                            <input class="form-control" value="{{ old('contact') }}" name="contact" id="contact" type="text" placeholder="Ex: 0x xx xx xx xx" required/>
                            <small class="ul-form__text form-text" id="">
                                Entrez le contact du fournisseur svp!
                            </small>
                            @if ($errors->has('contact'))
                                <div class="alert-danger p-2 rounded">
                                    {{ $errors->first('contact') }}
                                </div>
                            @endif
                        </div>
                        <div class="form-group col-md-4">
                            <label class="ul-form__label" for="email">Email:</label>
                            <input class="form-control" value="{{ old('email') }}" name="email" id="email" type="email" placeholder="Ex: example@domain.com" required/>
                            <small class="ul-form__text form-text" id="">
                                Entrez le email du fournisseur svp!
                            </small>
                            @if ($errors->has('email'))
                                <div class="alert-danger p-2 rounded">
                                    {{ $errors->first('email') }}
                                </div>
                            @endif
                        </div>
                        <div class="form-group col-md-4">
                            <label class="ul-form__label" for="type">Type fournisseur:</label>
                            <select id="type" name="type" class="form-control" required>
                                <option value="" selected>-- Sélectionner --</option>
                                @foreach ($types as $type)
                                    <option value="{{ $type->id }}" @if (old('type') == $type->id) selected="selected" @endif>{{ $type->name }}</option>
                                @endforeach
                            </select>
                            <small class="ul-form__text form-text" id="">
                                Choisissez le type du fournisseur svp!
                            </small>
                            @if ($errors->has('type'))
                                <div class="alert-danger p-2 rounded">
                                    {{ $errors->first('type') }}
                                </div>
                            @endif
                        </div>
                        <div class="form-group col-md-8">
                            <label class="col-form-label" for="localisation">Localisation: </label>
                            <textarea class="form-control" name="localisation" id="localisation" cols="30" rows="1" placeholder="Veuillez renseigner la localisation du fournisseur (Ce champs est facultatif)">@if (old('localisation')) {{ old('localisation') }} @endif</textarea>
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
                            <textarea class="form-control" name="description" id="description" cols="30" rows="9" placeholder="Veuillez donner une description du fournisseur (Ce champs est facultatif)">@if (old('description')) {{ old('description') }} @endif</textarea>
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
