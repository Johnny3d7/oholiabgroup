@extends('main.achats.partials.main')

@section('title', 'Ajout de Fiches de besoins -')

{{-- @section('stylesheets')
<style>
    label {
    margin-top: 35px;
    margin-bottom: 20px !important;
    display: flex;
    margin-bottom: 0.5rem;
}
</style>
@endsection --}}

@section('menuTitle')
Ajout Bon d'Expression de Besoins
@endsection

@section('pageTitle')
Ajout de bon d'expression de besoins
@endsection

@section('content')
<div class="row justify-content-center">
    <div class="container-fluid">
        {{-- <section class="ul-product-detail__box">
            <div class="row">
                    <div class="col-lg-3 col-md-3 mt-1 mb-4 text-center">
                        <a href="{{ route('stock.products.index')}}">
                        <div class="card">
                            <div class="card-body">
                                <div class="ul-product-detail__border-box">
                                    <div class="ul-product-detail--icon mb-2"><i class="i-Check text-success text-25 font-weight-500"></i></div>
                                    <h5 class="heading">Liste des fiches</h5>
                                    <p class="text-muted text-12">Afficher la liste de toutes les fiches.</p>
                                </div>
                            </div>
                        </div>
                    </a>
                    </div>
            </div>
        </section> --}}
        <div class="card animate__animated animate__backInDown">
            <div class="card-header bg-transparent">
                <h3 class="card-title">Ajout d'un bon d'expression de besoins</h3>
            </div>
            <form method="post" action="{{ route('achats.besoins.store')}}">
                @csrf
                @method('POST')
                <div class="card-body">
                    <div class="form-row">
                        <div class="form-group col-md-6 col-lg-4">
                            <label class="ul-form__label">Entreprise concernée</label>
                            <div class="">
                                @foreach ($entreprises->sortBy('name') as $entreprise)
                                    <label class="radio radio-outline-primary ml-5" style="display: inline">
                                        <input type="radio" name="id_entreprises" value="{{ $entreprise->id }}" @if (old('id_entreprises') == $entreprise->id) selected="checked" @endif required>
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
                        <div class="col-md-4 form-group mb-3">
                            <label for="employe">Employé</label>
                            <input class="form-control @error('employe') is-invalid @enderror" id="employe" name="employe" value="{{ old('employe') }}" type="text" placeholder="Entrez le nom complet de l'employé" required />
                            <small class="ul-form__text form-text" id="">
                                Saisissez le nom complet du demandeur svp!
                            </small>
                            @if ($errors->has('employe'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('employe') }}
                                </div>
                            @endif
                        </div>
                        <div class="form-group col-md-2 mb-3">
                            <label for="date_emission">Date d'émission</label>
                            <input class="form-control" id="date_emission" type="text" name="date_emission" data-inputmask='"mask": "99-99-9999"' data-mask required/>
                            <small class="ul-form__text form-text" id="">
                                Saisissez la date d'émission du bon svp!
                            </small>
                            @if ($errors->has('date_emission'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('date_emission') }}
                                </div>
                            @endif
                        </div>
                        <div class="form-group col-md-2 mb-3">
                            <label for="date_livraison">Date de livraison</label>
                            <input class="form-control" id="date_livraison" type="text" name="date_livraison" data-inputmask='"mask": "99-99-9999"' data-mask required/>
                            <small class="ul-form__text form-text" id="">
                                Saisissez le niveau d'urgence du bon svp!
                            </small>
                            @if ($errors->has('date_livraison'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('date_livraison') }}
                                </div>
                            @endif
                        </div>
                        <div class="col-md-4 form-group mb-3">
                            <label for="nature">Nature du besoin</label>
                            <input class="form-control @error('nature') is-invalid @enderror" id="nature" name="nature" value="{{ old('nature') }}" type="text" placeholder="Ex: Matériels" />
                            <small class="ul-form__text form-text" id="">
                                Saisissez la nature du besoin svp!
                            </small>
                            @if ($errors->has('nature'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('nature') }}
                                </div>
                            @endif
                        </div>
                        <div class="col form-group mb-3">
                            <label for="observations">Observations</label>
                            <textarea class="form-control @error('observations') is-invalid @enderror" id="observations" name="observations" cols="30" rows="1"></textarea>
                            {{-- <input class="form-control value="{{ old('observations') }}" type="text" placeholder="Ex: Matériels" /> --}}
                            <small class="ul-form__text form-text" id="">
                                Saisissez la observations du besoin svp!
                            </small>
                            @if ($errors->has('observations'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('observations') }}
                                </div>
                            @endif
                        </div>
    
                        <div class="col-md-12">
                            <button class="btn btn-primary">Valider</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('javascripts')
<script>
    $('[data-mask]').inputmask();
</script>
@endsection