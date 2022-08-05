@extends('main.stock.partials.main')

@section('title', "Formulaire d'inventaire -")

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
Formulaire d'inventaire
@endsection

@section('pageTitle')
Formulaire d'inventaire
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
                <h3 class="card-title">Formulaire d'inventaire</h3>
            </div>
            <form method="post" action="{{ route('stock.inventaires.procedePost', $inventaire)}}">
                @csrf
                @method('POST')
                <div class="card-body">
                    <div class="form-row">
                        @php
                            $entrepot = $inventaire->entrepot;
                            $e = $entrepot->entreprise->id;
                            $color = ($e == 1) ? 'success' : (($e == 2) ? 'info' : (($e == 3) ? 'primary' : ''));
                        @endphp
                        <div class="form-group col-md-6 col-lg-4 pr-2 text-center">
                            <h3 class="heading mb-4">Date Inventaire</h3>
                            <i class="i-Calendar-4 text-50 font-weight-500 d-block"></i>
                            <h3 class="mt-2 mb-3">{{ ucwords((new Carbon($inventaire->date_inventaire))->locale('fr')->isoFormat('DD/MM/YYYY')) }}</h3>
                        </div>
                        <div class="form-group col-md-6 col-lg-4 pr-2 text-center">
                            <h3 class="heading mb-4">Entreprise</h3>
                            <img src="{{ asset($entrepot->entreprise->logo) }}" alt="" style="height: 4rem;">
                            <h3 class="mt-2 mb-3">{{ $entrepot->entreprise->name }}</h3>
                        </div>
                        <div class="form-group col-md-6 col-lg-4 pr-2 text-center">
                            <h3 class="heading mb-4">Entrepot</h3>
                            <i class="i-Shop{{ $e <> 1 ? '-'.$e : '' }} text-{{ $color }} text-50 font-weight-500 d-block"></i>
                            <h3 class="mt-2 mb-3">{{ $entrepot->name }}</h3>
                        </div>
                    </div>

                    <div class="custom-separator"></div>
                    <h4>Articles concernés</h4>
                    <div class="articles">
                        @php
                            $products = $entrepot->products()->sortBy('name');
                            $key = 0;
                            // dd($entrepot->ehp);
                        @endphp
                        @foreach ($products as $product)
                            @php $key++; @endphp
                            @if($key!=1) <div class="custom-separator"></div> @endif
                            <div class="row">
                                <div class="container text-center">
                                    {{-- <h5 class="title">Article {{ $key }}</span></h5> --}}
                                    <h5 class="">{{ $product->name }}</span></h5>
                                </div>
                                <div class="container-fluid">
                                    <div class="form-row">
                                        <input type="hidden" class="form-control" id="id_products_{{ $key }}" name="id_products_{{ $key }}" value="{{ $product->id }}" required />
                                        <div class="col-md-2 col-lg-1">
                                            <img class="w-100" src="{{ asset($product->image) }}" alt="">
                                        </div>
                                        <div class="col-md-10 col-lg-11">
                                            <div class="row">
                                                <div class="col-sm-6 col-lg-3 form-group mb-3 qteArticle">
                                                    <label for="qte_att_{{ $key }}">Quantité Attendue</label>
                                                    <input type="number" min="1" step="1" class="form-control @error("qte_att_$key") is-invalid @enderror" id="qte_att_{{ $key }}" name="qte_att_{{ $key }}" value="{{ $entrepot->ehp($product)->quantite }}" type="text" placeholder="Ex: 1" required disabled readonly />
                                                    <small class="ul-form__text form-text" id="">
                                                        Vérifiez la quantité attendue svp!
                                                    </small>
                                                    @if ($errors->has("qte_att_$key"))
                                                        <div class="invalid-feedback">
                                                            {{ $errors->first("qte_att_$key") }}
                                                        </div>
                                                    @endif
                                                </div>

                                                <div class="col-sm-6 col-lg-3 form-group mb-3 qteArticle">
                                                    <label for="qte_res_{{ $key }}">Quantité Réelle</label>
                                                    <input type="number" min="0" step="1" class="form-control @error("qte_res_$key") is-invalid @enderror" id="qte_res_{{ $key }}" name="qte_res_{{ $key }}" value="{{ old("qte_res_$key") }}" type="text" placeholder="Ex: 1" required />
                                                    <small class="ul-form__text form-text" id="">
                                                        Saisissez la quantité réelle svp!
                                                    </small>
                                                    @if ($errors->has("qte_res_$key"))
                                                        <div class="invalid-feedback">
                                                            {{ $errors->first("qte_res_$key") }}
                                                        </div>
                                                    @endif
                                                </div>

                                                <div class="col-sm-4 col-lg-2 form-group mb-3">
                                                    <label for="statut_{{ $key }}">Statut</label>
                                                    <select class="form-control select2" data-placeholder="Veuillez sélectionner" id="statut_{{ $key }}" name="statut_{{ $key }}">
                                                        <option value="">-- Selectionner --</option>
                                                        <option value="invalide">Invalide</option>
                                                        <option value="valide">Valide</option>
                                                    </select>
                                                    <small class="ul-form__text form-text" id="">
                                                        Selectionnez le statut svp!
                                                    </small>
                                                    @if ($errors->has("statut_$key"))
                                                        <div class="invalid-feedback">
                                                            {{ $errors->first("statut_$key") }}
                                                        </div>
                                                    @endif
                                                </div>

                                                <div class="col form-group mb-3 obsArticle">
                                                    <label for="observations_{{ $key }}">Observations</label>
                                                    <textarea class="form-control @error("observations_$key") is-invalid @enderror" id="observations_{{ $key }}" name="observations_{{ $key }}" cols="30" rows="1"></textarea>
                                                    {{-- <input class="form-control value="{{ old('observations') }}" type="text" placeholder="Ex: Matériels" /> --}}
                                                    <small class="ul-form__text form-text" id="">
                                                        Saisissez les observations de la ligne svp!
                                                    </small>
                                                    @if ($errors->has("observations_$key"))
                                                        <div class="invalid-feedback">
                                                            {{ $errors->first("observations_$key") }}
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
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
        </div>
    </div>
</div>
@endsection

@section('javascripts')
<script>
    $('[data-mask]').inputmask();

    $(function(){

        $(document).ready(function(){
        })

    })
</script>
@endsection
