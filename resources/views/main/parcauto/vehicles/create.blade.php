@extends('main.parcauto.partials.main',[
    'pageTitle' => "Ajout d'un nouveau véhicule"
])

@section('stylesheets')
<style>
    .card-icon-bg .card-body .content {
        max-width: 70%;
    }
</style>
<link rel="stylesheet" href="{{ asset('myplugins/dropify/css/dropify.css') }}" />
@endsection

@section('menuTitle')
Gestion du parc automobile
@endsection

@section('pageTitle')
Ajout d'un nouveau véhicule
@endsection

@section('content')
<div class="row">
    <div class="container-fluid">
        <section class="ul-product-detail__box">
            <div class="row">
                    <div class="col-lg-3 col-md-3 mt-1 mb-4 text-center">
                        <a href="{{ route('parcauto.vehicles.index')}}">
                        <div class="card">
                            <div class="card-body">
                                <div class="ul-product-detail__border-box">
                                    <div class="ul-product-detail--icon mb-2"><i class="i-Check text-success text-25 font-weight-500"></i></div>
                                    <h5 class="heading">Liste des véhicules</h5>
                                    <p class="text-muted text-12">Afficher la liste de tous les véhicules.</p>
                                </div>
                            </div>
                        </div>
                    </a>
                    </div>
            </div>
        </section>

        <div class="card animate__animated animate__backInDown">
            <div class="card-header bg-transparent">
            <h3 class="card-title">Ajout d'un nouveau véhicule</h3>
            </div>
            <!-- begin::form-->
            <form method="post" action="{{ route('parcauto.vehicles.store')}}" enctype="multipart/form-data">
                @csrf
                @method('POST')
                <div class="card-body">
                    <div class="form-row">
                        <div class="form-group col-lg-3 col-md-6">
                            <label class="ul-form__label" for="reference">Reference:</label>
                            <input class="form-control" value="{{ old('reference') }}" name="reference" id="reference" type="text" placeholder="Ex: PC00001" required/>
                            <small class="ul-form__text form-text" id="">
                                Entrez la reference du véhicule svp!
                            </small>
                            @if ($errors->has('reference'))
                                <div class="alert-danger p-2 rounded">
                                    {{ $errors->first('reference') }}
                                </div>
                            @endif
                        </div>
                        <div class="form-group col-lg-3 col-md-6">
                            <label class="ul-form__label" for="date_emission">Date d'émission:</label>
                            <input class="form-control" value="{{ old('date_emission') }}" name="date_emission" id="date_emission" type="date" placeholder="" required/>
                            <small class="ul-form__text form-text" id="">
                                Entrez la date d'émission du véhicule svp!
                            </small>
                            @if ($errors->has('date_emission'))
                                <div class="alert-danger p-2 rounded">
                                    {{ $errors->first('date_emission') }}
                                </div>
                            @endif
                        </div>
                        <div class="form-group col-lg-3 col-md-6">
                            <label class="ul-form__label" for="montant">Montant:</label>
                            <input class="form-control" value="{{ old('montant') }}" name="montant" id="montant" type="text" placeholder="Ex: 10000" required/>
                            <small class="ul-form__text form-text" id="">
                                Entrez la montant du véhicule svp!
                            </small>
                            @if ($errors->has('montant'))
                                <div class="alert-danger p-2 rounded">
                                    {{ $errors->first('montant') }}
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="custom-separator"></div>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label class="col-form-label" for="file">Fichier Source (.png | .jpg | .jpeg | .pdf): </label>
                            <input type="file" name="file" class="dropify-fr" data-bs-height="180" accept=".png, .jpg, .jpeg, .pdf" />
                        </div>
                        <div class="form-group col-md-8">
                            <label class="col-form-label" for="description">Description: </label>
                            <textarea class="form-control" name="description" id="description" cols="30" rows="9" placeholder="Veuillez donner une description du véhicule (Ce champs est facultatif)">@if (old('description')) {{ old('description') }} @endif</textarea>
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
<script src="{{ asset('myplugins/dropify/js/dropify.js') }}"></script>
<script>
    // Basic
    $('.dropify').dropify();

    // Translated
    $('.dropify-fr').dropify({
        messages: {
            default: 'Glissez-déposez un fichier ici ou cliquez',
            replace: 'Glissez-déposez un fichier ou cliquez pour remplacer',
            remove:  'Supprimer <i class="i-Remove"></i>',
            error:   'Désolé, le fichier est trop volumineux'
        }
    });
</script>
@endsection
