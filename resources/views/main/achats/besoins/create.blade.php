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
                            <input class="form-control" id="date_emission" type="date" name="date_emission" data-inputmask='"mask": "99-99-9999"' data-mask required/>
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
                            <input class="form-control" id="date_livraison" type="date" name="date_livraison" data-inputmask='"mask": "99-99-9999"' data-mask required/>
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
                                Saisissez les observations du bon d'expression des besoins svp!
                            </small>
                            @if ($errors->has('observations'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('observations') }}
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="custom-separator"></div>
                    <h4>Articles concernés</h4>
                    <div class="articles">
                        @for ($key = 1; $key < 2; $key++)
                            @if($key!=1) <div class="custom-separator" data-keyrow="{{ $key }}"></div> @endif
                            <div class="row ArticleRow" data-keyrow="{{ $key }}">
                                <div class="container text-center">
                                    <h5 class="title">Article <span>{{ $key }}</span></h5>
                                </div>
                                <div class="col-md-11">
                                    <div class="form-row">
                                        <div class="col-md-4 form-group mb-3">
                                            <label for="article_{{ $key }}">Libéllé Article</label>
                                            <input class="form-control @error("article_$key") is-invalid @enderror" id="article_{{ $key }}" name="article_{{ $key }}" value="{{ old("article_$key") }}" type="text" placeholder="Ex: Matériels" />
                                            <small class="ul-form__text form-text" id="">
                                                Saisissez le libéllé de l'article svp!
                                            </small>
                                            @if ($errors->has("article_$key"))
                                                <div class="invalid-feedback">
                                                    {{ $errors->first("article_$key") }}
                                                </div>
                                            @endif
                                        </div>
                                        
                                        <div class="col-md-2 form-group mb-3">
                                            <label for="prix_{{ $key }}">Prix Unitaire</label>
                                            <input type="number" min="50" step="50" class="form-control @error("prix_$key") is-invalid @enderror" id="prix_{{ $key }}" name="prix_{{ $key }}" value="{{ old("prix_$key") }}" type="text" placeholder="Ex: 3000" />
                                            <small class="ul-form__text form-text" id="">
                                                Saisissez le prix unitaire de l'article svp!
                                            </small>
                                            @if ($errors->has("prix_$key"))
                                                <div class="invalid-feedback">
                                                    {{ $errors->first("prix_$key") }}
                                                </div>
                                            @endif
                                        </div>
                                        
                                        <div class="col-md-1 form-group mb-3">
                                            <label for="quantite_{{ $key }}">Quantité</label>
                                            <input type="number" min="1" step="1" class="form-control @error("quantite_$key") is-invalid @enderror" id="quantite_{{ $key }}" name="quantite_{{ $key }}" value="{{ old("quantite_$key") }}" type="text" placeholder="Ex: 1" />
                                            <small class="ul-form__text form-text" id="">
                                                Saisissez la quantité nécessaire svp!
                                            </small>
                                            @if ($errors->has("quantite_$key"))
                                                <div class="invalid-feedback">
                                                    {{ $errors->first("quantite_$key") }}
                                                </div>
                                            @endif
                                        </div>
                                        
                                        <div class="col-md-2 form-group mb-3">
                                            <label>Montant</label>
                                            <input class="form-control montant" value="{{ old("quantite_$key") }}" type="text" readonly disabled placeholder="0" />
                                            <small class="ul-form__text form-text" id="">
                                                Montant de l'article (Prix * Quantité)!
                                            </small>
                                        </div>
                                        
                                        <div class="col form-group mb-3">
                                            <label for="observations_{{ $key }}">Observations</label>
                                            <textarea class="form-control @error("observations_$key") is-invalid @enderror" id="observations_{{ $key }}" name="observations_{{ $key }}" cols="30" rows="1"></textarea>
                                            {{-- <input class="form-control value="{{ old('observations') }}" type="text" placeholder="Ex: Matériels" /> --}}
                                            <small class="ul-form__text form-text" id="">
                                                Saisissez la observations du besoin svp!
                                            </small>
                                            @if ($errors->has("observations_$key"))
                                                <div class="invalid-feedback">
                                                    {{ $errors->first("observations_$key") }}
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-1 text-center">
                                    <button class="btn btn-icon btn-outline-danger border-0 rounded-circle btn-RemoveRow" type="button" style="height: 2.5rem; width: 2.5rem;">
                                        <span class="ul-btn__icon"><i class="i-Remove text-30"></i></span>
                                    </button>
                                    <span class="text-danger spanLink d-block">Retirer</span>
                                </div>
                            </div>
                        @endfor
                    </div>
                    <div class="text-center">
                        <button class="btn btn-icon btn-outline-info border-0 rounded-circle btn-AddRow" type="button" style="height: 2.5rem; width: 2.5rem;">
                            <span class="ul-btn__icon"><i class="i-Add text-30"></i></span>
                        </button>
                        <span class="text-info spanLink">Ajouter</span>
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
        function refresh(){
            let cpte = 1;
            $('.articles').children('.row').each(function(){
                $(this).attr('data-keyrow', cpte);
                $(this).find('.title:first').html(`Article ${cpte}`);

                $($(this).find('.lblArticle:first').find('label')).attr('for', `article_${cpte}`);
                $($(this).find('.lblArticle:first').find('input')).attr('id', `article_${cpte}`).attr('name', `article_${cpte}`);

                $($(this).find('.puArticle:first').find('label')).attr('for', `prix_${cpte}`);
                $($(this).find('.puArticle:first').find('input')).attr('id', `prix_${cpte}`).attr('name', `prix_${cpte}`);

                $($(this).find('.qteArticle:first').find('label')).attr('for', `quantite_${cpte}`);
                $($(this).find('.qteArticle:first').find('input')).attr('id', `quantite_${cpte}`).attr('name', `quantite_${cpte}`);

                $($(this).find('.obsArticle:first').find('label')).attr('for', `observations_${cpte}`);
                $($(this).find('.obsArticle:first').find('textarea')).attr('id', `observations_${cpte}`).attr('name', `observations_${cpte}`);

                cpte++;
            });

            cpte = 2;
            $('.articles').children('.custom-separator').each(function(){
                console.log($(this).attr('data-keyrow'));
                $(this).attr('data-keyrow', cpte);
                cpte++;
            });

            if(!$('.articles').children('.row').length){ $('.btn-AddRow').click(); }
        }

        function AddArticleRow(key){
            sep = (key > 1) ? `<div class="custom-separator" data-keyrow="${key}"></div>` : ''
            return `
                ${sep}
                <div class="row ArticleRow" data-keyrow="${key}">
                    <div class="container text-center">
                        <h5 class="title">Article <span>${key}</span></h5>
                    </div>
                    <div class="col-md-11">
                        <div class="form-row">
                            <div class="col-md-4 form-group mb-3 lblArticle">
                                <label for="article_${key}">Libéllé Article</label>
                                <input class="form-control" id="article_${key}" name="article_${key}" type="text" placeholder="Ex: Matériels" />
                                <small class="ul-form__text form-text" id="">
                                    Saisissez le libéllé de l'article svp!
                                </small>
                            </div>
                            
                            <div class="col-md-2 form-group mb-3 puArticle">
                                <label for="prix_${key}">Prix Unitaire</label>
                                <input type="number" min="50" step="50" class="form-control" id="prix_${key}" name="prix_${key}" type="text" placeholder="Ex: 3000" />
                                <small class="ul-form__text form-text" id="">
                                    Saisissez le prix unitaire de l'article svp!
                                </small>
                            </div>
                            
                            <div class="col-md-1 form-group mb-3 qteArticle">
                                <label for="quantite_${key}">Quantité</label>
                                <input type="number" min="1" step="1" class="form-control" id="quantite_${key}" name="quantite_${key}" type="text" placeholder="Ex: 1" />
                                <small class="ul-form__text form-text" id="">
                                    Saisissez la quantité nécessaire svp!
                                </small>
                            </div>
                            
                            <div class="col-md-2 form-group mb-3 mntArticle">
                                <label>Montant</label>
                                <input class="form-control montant" type="text" readonly disabled placeholder="0" />
                                <small class="ul-form__text form-text" id="">
                                    Montant de l'article (Prix * Quantité)!
                                </small>
                            </div>
                            
                            <div class="col form-group mb-3 obsArticle">
                                <label for="observations_${key}">Observations</label>
                                <textarea class="form-control" id="observations_${key}" name="observations_${key}" cols="30" rows="1"></textarea>
                                <small class="ul-form__text form-text" id="">
                                    Saisissez la observations du besoin svp!
                                </small>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-1 text-center">
                        <button class="btn btn-icon btn-outline-danger border-0 rounded-circle btn-RemoveRow" type="button" style="height: 2.5rem; width: 2.5rem;">
                            <span class="ul-btn__icon"><i class="i-Remove text-30"></i></span>
                        </button>
                        <span class="text-danger spanLink d-block">Retirer</span>
                    </div>
                </div>
            `;
        }

        function RemoveArticleRow(key){
            console.log("Removing function " + key)
            toDelete = $(`[data-keyrow=${key}]`)
            if(key==1) $(`[data-keyrow=2]`).remove();
            toDelete.each(function(){
                $(this).remove()
                refresh();
            })
        }


        $('.spanLink').each(function(){
            $(this).css({'cursor':'pointer'});

            $($(this)).hover(function(){
                $($($(this).parent()).find('button:first')).mouseenter()
            },function(){
                $($(this).parent()).find('button:first').mouseout()
            })

            $($(this)).click(function(){
                $($(this).parent()).find('button:first').click()
            })
        })

        $('.btn-RemoveRow').click(function(){
            console.log('Removing javascript row')
            key = $($(this).parents('.ArticleRow')[0]).data('keyrow');
            RemoveArticleRow(key);
            // toDelete = $(`[data-keyrow=${key}]`)
            // toDelete.each(function(){
            //     // $(this).remove()
            // })
        })

        $('.btn-AddRow').click(function(){
            console.log('Adding javascript row');
            nbre = $('.articles').children('.row').length + 1;

            $('.articles').append(AddArticleRow(nbre));

            $(`.ArticleRow[data-keyrow=${nbre}]`).ready(function(){
                spanLink = $(`.ArticleRow[data-keyrow=${nbre}]`).find('.spanLink');
                spanLink.css({'cursor':'pointer'});

                btn = $(`.ArticleRow[data-keyrow=${nbre}]`).find('.btn-RemoveRow');
                btn.click(function(){
                    key = $($(this).parents('.ArticleRow')[0]).data('keyrow')
                    RemoveArticleRow(key);
                })

                console.log(spanLink);
                spanLink.click(function(){
                    spanLink.parent().find('button:first').click()
                })
            })
        })
       
    })
</script>
@endsection