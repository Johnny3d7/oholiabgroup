@extends('main.stock.partials.main')

@section('title', "Ajout d'inventaire -")

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
Ajout d'inventaire
@endsection

@section('pageTitle')
Ajout d'inventaire
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
                <h3 class="card-title">Ajout d'un inventaire</h3>
            </div>
            <form method="post" action="{{ route('stock.inventaires.store')}}">
                @csrf
                @method('POST')
                <div class="card-body">
                    <div class="form-row">
                        <div class="form-group col-md-6 col-lg-5 pr-2">
                            <label class="ul-form__label">Entrepot concerné</label>
                            <div style="max-height: 12rem; overflow-y: auto;">
                                @foreach ($entrepots->sortBy('name') as $entrepot)
                                    @php
                                        $e = $entrepot->entreprise->id;
                                        $color = ($e == 1) ? 'success' : (($e == 2) ? 'info' : (($e == 3) ? 'primary' : ''));
                                    @endphp
                                    <label class="radio radio-outline-{{ $color }} ml-5 d-inline-flex mb-3">
                                        <input type="radio" name="id_entrepots" value="{{ $entrepot->id }}" @if (old('id_entrepots') == $entrepot->id) selected @endif required>
                                        <span>
                                            <i class="i-Shop{{ $e <> 1 ? '-'.$e : '' }} text-{{ $color }} text-50 font-weight-500 d-block"></i>
                                            <span class="d-block" style="max-width: 6.5rem;">{{ $entrepot->name }}</span>
                                        </span>
                                        <span class="checkmark"></span>
                                    </label>
                                @endforeach
                            </div>
                            @if ($errors->has('id_entrepots'))
                                <div class="alert-danger p-2 rounded">
                                    {{ $errors->first('id_entrepots') }}
                                </div>
                            @endif
                        </div>

                        <div class="col-md-6 col-lg-7">
                            <div class="row">
                                <div class="col-md-6 form-group mb-3">
                                    <label for="name">Titre</label>
                                    <input class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" type="text" placeholder="Entrez le titre de l'inventaire" required />
                                    <small class="ul-form__text form-text" id="">
                                        Saisissez le titre de l'inventaire svp!
                                    </small>
                                    @if ($errors->has('name'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('name') }}
                                        </div>
                                    @endif
                                </div>
                                <div class="col-md-6 form-group mb-3">
                                    <label for="date_inventaire">Date</label>
                                    <input class="form-control" id="date_inventaire" type="date" name="date_inventaire" data-inputmask='"mask": "99-99-9999"' data-mask required/>
                                    <small class="ul-form__text form-text" id="">
                                        Saisissez la date de l'inventaire svp!
                                    </small>
                                    @if ($errors->has('date_inventaire'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('date_inventaire') }}
                                        </div>
                                    @endif
                                </div>
                                <div class="col-md-12 form-group mb-3">
                                    <label for="observations">Observations</label>
                                    <textarea class="form-control @error('observations') is-invalid @enderror" id="observations" name="observations" cols="30" rows="1"></textarea>
                                    {{-- <input class="form-control value="{{ old('observations') }}" type="text" placeholder="Ex: Matériels" /> --}}
                                    <small class="ul-form__text form-text" id="">
                                        Saisissez les observations du bon d'expression des besoins svp!
                                    </small>
                                    @if ($errors->has('observations'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('observations') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="mc-footer">
                        <div class="row">
                            <div class="container text-center">
                                <label class="checkbox checkbox-outline-primary mr-2 d-inline-flex">
                                    <input type="checkbox" name="procede" id="" value="oui" checked> <span>Procéder à l'inventaire après ajout</span>
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                            <div class="col-lg-12 text-center">
                                {{-- <input type="checkbox" name="procede" id="" value="oui" checked> <span>Procéder à l'inventaire</span> --}}
                                <button class="btn btn-primary m-1" type="submit">Valider</button>
                                <button class="btn btn-outline-secondary m-1" type="reset">annuler</button>
                            </div>
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

</script>
@endsection
