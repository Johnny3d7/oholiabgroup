@php
    use Carbon\Carbon;
@endphp

@extends('main.achats.partials.main')

@section('title', 'Liste Fiches de besoins -')

@section('stylesheets')
<style>
    label {
    margin-top: 35px;
    margin-bottom: 20px !important;
    display: flex;
    margin-bottom: 0.5rem;
}
</style>
@endsection

@section('menuTitle')
Expressions Besoins
@endsection

@section('pageTitle')
Détails de bon d'expression de besoins
@endsection

@section('content')
<div class="row">
    <div class="col-md-12 col-lg-8 pb-2">
        <div class="card h-100">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-4 text-center p-5 pt-0">
                        <h3 class="text-dark mb-5">Entreprise</h3>
                        <img src="{{ asset($besoin->entreprise->logo) }}" class="pt-1" alt="" style="height: 5rem;">
                        <h3 class="mt-2">{{ $besoin->entreprise->name }}</h3>
                    </div>
                    <div class="col-lg-8">
                        <div class="ul-product-detail__brand-name mb-4">
                            <h2 class="heading">{{ $besoin->nature }}</h2>
                        </div>

                        <div class="ul-product-detail__features mt-4">
                            {{-- <h5 class="font-weight-700">Caractéristiques du besoin:</h5> --}}
                            <ul class="m-0 p-0">
                                <div class="ul-widget-app__browser-list-1 mb-2 mt-4">
                                    <i class="i-Spell-Check text-white teal-500 rounded-circle p-2 mr-3"></i>
                                    <span class="text-15"><strong>Montant Total :</strong> {{ number_format($besoin->montant(), 0, ',', ' ') }} F CFA </span>
                                    <span class="text-mute" style="display: none">2 April </span>
                                </div>
                                <div class="ul-widget-app__browser-list-1 mb-2">
                                    <i class="i-Spell-Check text-white teal-500 rounded-circle p-2 mr-3"></i>
                                    <span class="text-15"><strong>Date d'émission :</strong> {{ ucwords((new Carbon($besoin->date_emission))->locale('fr')->isoFormat('DD/MM/YYYY')) }} </span>
                                    <span class="text-mute" style="display: none">2 April </span>
                                </div>
                                <div class="ul-widget-app__browser-list-1 mb-2">
                                    <i class="i-Check text-white teal-500 rounded-circle p-2 mr-3"></i>
                                    <span class="text-15"><strong>Date de livraison :</strong> {{ ucwords((new Carbon($besoin->date_livraison))->locale('fr')->isoFormat('DD/MM/YYYY')) }}</span>
                                    <span class="text-mute" style="display: none">2 April </span>
                                </div>
                                <div class="ul-widget-app__browser-list-1 mb-2 ">
                                    <i class="i-Spell-Check text-white teal-500 rounded-circle p-2 mr-3"></i>
                                    <span class="text-15"><strong>Observations :</strong></span>
                                    <span class="text-mute" style="display: none">2 April </span>
                                </div>
                                <p style="max-height: 5rem; overflow-x: auto;">
                                    {{ $besoin->observations }}
                                </p>
                            </ul>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-2 pb-2">
        <div class="card h-100">
            <div class="card-body text-center px-2">
                <h3 class="text-dark mb-3">Statut</h3>
                @switch($besoin->statut)
                    @case('traité')
                    <i class="i-Yes text-78 text-primary mt-5"></i>
                    <h3 class="mt-2 text-primary">{{ ucfirst($besoin->statut) }}</h3>
                        @break
                    @case('validé')
                    <i class="i-Yes text-78 text-success mt-5"></i>
                    <h3 class="mt-2 text-success">{{ ucfirst($besoin->statut) }}</h3>
                        @break
                    @case('refusé')
                    <i class="i-Close text-78 text-danger"></i>
                    <h3 class="mt-2 text-danger">{{ ucfirst($besoin->statut) }}</h3>
                        @break
                    @case('annulé')
                    <i class="i-Close text-78 text-warning"></i>
                    <h3 class="mt-2 text-warning">{{ ucfirst($besoin->statut) }}</h3>
                    @break
                    @default
                    <i class="i-Loading-3 text-78 text-info mt-5"></i>
                    <h3 class="mt-2 text-info">{{ ucfirst($besoin->statut) }}</h3>
                @endswitch
                @if ($besoin->statut == 'refusé')
                    <div class="alert alert-danger h5">{{ $besoin->motif }}</div>
                @endif
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-2 pb-2">
        <div class="card h-100">
            <div class="card-body text-center">
                <h3 class="text-dark mb-4">Actions</h3>
                @role('Directrice Générale')
                    @if (!in_array($besoin->statut, ['validé', 'refusé', 'annulé', 'traité']))
                        <button type="button" data-link="{{ route('achats.besoins.validation', ['besoin' => $besoin, 'statut' => 'valide']) }}" class="btn btn-lg btn-success ripple btn-block text-16 mb-3 btnValiderSelected">
                            <i class="i-Yes text-30"></i>
                            <span class="d-block">Valider <span class="nbreSelected">({{ $besoin->lignes->where('statut', 'en attente')->count() }} art.)</span></span>
                        </button>
                        <button type="button" data-link="{{ route('achats.besoins.validation', ['besoin' => $besoin, 'statut' => 'invalide']) }}" class="btn btn-lg btn-danger ripple btn-block text-16 btnRefuserSelected">
                            <i class="i-Close text-30"></i>
                            <span class="d-block">Refuser <span class="nbreSelected">({{ $besoin->lignes->where('statut', 'en attente')->count() }} art.)</span></span>
                        </button>
                    @else
                        <h6 class="text-center">Aucune action disponible !</h6>
                    @endif
                @endrole

                @role("Chargé d'Achats")
                    @if (in_array($besoin->statut, ['en attente', 'refusé', 'annulé']))
                        <a href="{{ route('achats.besoins.edit', $besoin) }}" class="btn btn-md btn-success ripple btn-block text-16 mb-3">
                            <i class="i-Pen-4 text-30"></i>
                            <span class="d-block">Editer</span>
                        </a>
                        @if ($besoin->statut == 'en attente')
                            <button type="button" data-link="{{ route('achats.besoins.validation', ['besoin' => $besoin, 'statut' => 'annulé']) }}" class="btn btn-md btn-warning ripple btn-block text-16 mb-3 btnAnnuler">
                                <i class="i-Close text-30"></i>
                                <span class="d-block">Annuler</span>
                            </button>
                        @endif
                    @else
                        @if ($besoin->statut == 'validé')
                            <a href="{{ route('achats.besoins.edit', $besoin) }}" class="btn btn-md btn-info ripple btn-block text-16 mb-3">
                                <i class="i-Shopping-Cart text-30"></i>
                                <span class="d-block">Procéder à l'achat</span>
                            </a>
                        @else
                            <h6 class="text-center">Aucune action disponible !</h6>
                        @endif
                    @endif
                @endrole
            </div>
        </div>
    </div>
</div>

<div class="row" id="articleGrid">
    @foreach ($besoin->lignes->sortBy('article') as $ligne)
        <div class="col-md-6 col-lg-4 mt-4">
            <div class="card">
                <div id="articleRow-{{ $ligne->id }}" class="card-body articleRow">

                    <div class="user-profile mb-4">
                        <div class="ul-widget-card__user-info row">
                            @role("Chargé d'Achats")
                                @if (in_array($besoin->statut, ['en attente' /*, 'refusé', 'annulé' */]))
                                    <a href="javascript:void(0);" data-toggle="modal" data-target="#edit_{{ $ligne->uuid }}_modal" class="btn btn-md btn-outline-success ripple text-16 mb-3" style="position: absolute; top:0.2rem; right: 0.2rem; z-index: 1000;">
                                        <i class="i-Pen-4 text-20"></i>
                                    </a>
                                        {{-- <span class="d-block">Editer</span>  --}}
                                @endif
                            @endrole
                            @role('Directrice Générale')
                                @if ($ligne->statut == 'en attente')
                                    <label class="checkbox checkbox-info">
                                        <input class="checkArticle" data-id={{ $ligne->id }} type="checkbox" checked="checked">
                                        <span class="checkmark" style="position: absolute; top:-3rem; left: 0; z-index: 1000; width: 30px; height: 30px;"></span>
                                    </label>
                                @endif
                            @endrole
                            {{--<div style="position: absolute; top:0.2rem; right: 0.2rem; z-index: 1000;">
                                <a href="javascript:void(0);" data-toggle="modal" data-target="#edit_{{ $ligne->uuid }}_modal">
                                    <i class="i-Yes text-30 text-success"></i>
                                </a>
                                <a href="javascript:void(0);" data-toggle="modal" data-target="#edit_{{ $ligne->uuid }}_modal" >
                                    <i class="i-Close text-30 text-danger"></i>
                                </a>
                            </div> --}}
                            <div class="col-md border-md-right">
                                <div class="ul-product-detail--icon mb-2">
                                    <a href="javascript:void(0);">
                                        <i class="i-Shopping-Bag text-primary text-25 font-weight-500" style="font-size: 50px;"></i>
                                    </a>
                                </div>
                                <a href="javascript:void(0);">
                                    <p class="m-0 text-18 heading">{{ $ligne->article }}</p>
                                </a>
                                <p>{{ $ligne->observations }}</p>
                            </div>
                            <div class="col-md pt-3">
                                <h3>
                                    <div class="text-muted h5">Prix Unitaire</div>
                                    <div>
                                        {{ number_format($ligne->prix, 0, ',', ' ') }} F CFA
                                    </div>
                                </h3>
                                <h3>
                                    <div class="text-muted h5">Quantité</div>
                                    <div>
                                        {{ number_format($ligne->quantite, 0, ',', ' ') }} {{ $ligne->unite }}
                                    </div>
                                </h3>
                            </div>
                        </div>
                    </div>
                    <div class="pt-2 border-top px-md-2 text-center">
                        <h5>
                            Montant : {{ number_format($ligne->montant(), 0, ',', ' ') }} F CFA
                        </h5>
                        {{-- <a href="" class="btn btn-outline-success m-1" type="button" data-toggle="modal" data-target="#add_variation{{ $product->id }}{{ $entrepot->id }}entrée"><i class="nav-icon i-Down mr-1"></i> Entrée </a>
                        <a href="" class="btn btn-outline-danger m-1" type="button" data-toggle="modal" data-target="#add_variation{{ $product->id }}{{ $entrepot->id }}sortie"><i class="nav-icon i-Up mr-1"></i> Sortie </a>
                        <a href="{{ route('stock.stock_story_entrepot.index',['entrepot'=>$entrepot, 'product'=> $product]) }}" class="btn btn-outline-warning m-1"><i class="nav-icon i-Repeat-4 mr-1"></i> Historique </a>
                        <a href="" class="btn btn-outline-primary m-1 float-right" type="button" data-toggle="modal" data-target="#add_variation{{ $product->id }}{{ $entrepot->id }}transfert"><i class="nav-icon i-Data-Transfer mr-1"></i> Transfert </a> --}}
                        {{-- <button class="btn btn-outline-success m-1 float-right" type="button">Message</button> --}}
                        {{-- <button class="btn btn-outline-success m-1 float-right" type="button">Message</button> --}}
                    </div>
                    @role('Directrice Générale')
                        @if ($ligne->statut == 'en attente')
                            <div class="pt-2 px-md-2 text-center row validationRow">
                                <div class="col-md-6">
                                    <button type="button" data-id="{{ $ligne->id }}" class="btn btn-md btn-success btn-block text-18 mb-3 btnValider">
                                        <i class="i-Yes text-18"></i>
                                        <span>Valider</span>
                                    </button>
                                </div>
                                <div class="col-md-6">
                                    <button type="button" data-id="{{ $ligne->id }}" class="btn btn-md btn-danger btn-block text-18 btnRefuser">
                                        <i class="i-Close text-18"></i>
                                        <span>Refuser</span>
                                    </button>
                                </div>
                            </div>
                        @else
                            <div class="alert alert-{{ $ligne->statut == 'refusé' ? 'danger' : 'info' }} text-center text-16 text-uppercase">{{ $ligne->statut }}{{ $ligne->motif ? ' : '.$ligne->motif  : '' }} </div>
                        @endif
                    @endrole
                    @role("Chargé d'Achats")
                        @if ($ligne->statut == 'validé')
                            <div class="pt-2 px-md-2 text-center">
                                <button type="button" data-id="{{ $ligne->id }}" class="btn btn-md btn-info btn-block text-18">
                                    <i class="i-Shopping-Cart text-18"></i>
                                    <span>Procéder à l'achat</span>
                                </button>
                            </div>
                        @else
                            <div class="alert alert-{{ $ligne->statut == 'refusé' ? 'danger' : 'info' }} text-center text-16 text-uppercase mb-0">{{ $ligne->statut }}{{ $ligne->motif ? ' : '.$ligne->motif  : '' }} </div>
                        @endif
                    @endrole
                </div>
            </div>
        </div>
        @role("Chargé d'Achats")
            @if (in_array($besoin->statut, ['en attente', 'refusé', 'annulé']))
                @include('main.achats.besoins._editLigne')
            @endif
        @endrole
    @endforeach
</div>

@endsection

@section('javascripts')
<script>

    function validateLignes(ids, statut, motif=null){
        HoldOn.open({
            theme:"sk-circle"
        });

        $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
        $.ajax({
            method: "POST",
            url: "{{ route('achats.besoins.lignes.validation') }}",
            data:{
                'api':'true',
                'statut':statut,
                'motif':motif,
                'id_lignes':ids
            },
            success : function( msg ) {
                ids.forEach(id => {
                    transforme(id, msg.statut, msg.motif)
                });
                Toast.fire({
                    'icon': 'success',
                    'title': msg.msg
                })
                HoldOn.close();
            },
            error : function( msg ) {
                console.log(msg);
                Toast.fire({
                    'icon': 'error',
                    'title': msg.responseJSON.msg ?? msg.responseJSON.message
                })
                HoldOn.close();
            }
        });
    }

    function transforme(id, statut, motif=null){
        parent = $('#articleRow-'+id);
        checkbox = parent.find('label.checkbox:first');
        validationRow = parent.find('.validationRow:first');

        checkbox.remove();
        validationRow.remove();
        parent.append(`<div class="alert alert-${statut == 'refusé' ? 'danger' : 'info'} text-center text-16 text-uppercase">${statut}${motif ? ': '+motif : ''}</div>`)
    }

    $(function(){
        $(document).ready(function(){
            nbreselected = "{{ $besoin->lignes->count() }}";
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-lg btn-success mx-1',
                    denyButton: 'btn btn-lg btn-danger mx-1',
                    cancelButton: 'btn btn-lg btn-secondary mx-1',
                },
                buttonsStyling: false
            });

            $('.checkbox').click(function(){
                nbreselected = $('#articleGrid').find('.checkArticle:checked').length;
                $('.nbreSelected').html(`(${nbreselected} art.)`);
            })

            $('.btnValider').click(function(){
                $valid = $(this);
                ids = [$(this).data('id')];

                swalWithBootstrapButtons.fire({
                    icon: 'question',
                    title: 'Souhaitez-vous continuer',
                    text: "Vous êtes sur le point de valider l'achat de l'article",
                    showCancelButton: true,
                    confirmButtonText: 'Valider',
                    cancelButtonText: `Annuler`

                }).then((result) => {
                    /* Read more about isConfirmed, isDenied below */
                    if(result.isConfirmed){
                        validateLignes(ids, 'valide');
                    }
                })
            });

            $('.btnValiderSelected').click(function(){
                $valid = $(this);
                ids = [];

                selected = $('#articleGrid').find('.checkArticle:checked');
                $.each(selected, function(){
                    ids.push($(this).data('id'))
                })

                swalWithBootstrapButtons.fire({
                    icon: 'question',
                    title: 'Souhaitez-vous continuer',
                    text: "Vous êtes sur le point de valider l'achat des articles sélectionnés \n("+nbreselected+" art.)",
                    showCancelButton: true,
                    confirmButtonText: 'Valider',
                    cancelButtonText: `Annuler`

                }).then((result) => {
                    /* Read more about isConfirmed, isDenied below */
                    if(result.isConfirmed){
                        validateLignes(ids, 'valide');
                    }
                })
            });

            $('.btnRefuser').click(function(){
                $invalid = $(this);
                ids = [$(this).data('id')];

                swalWithBootstrapButtons.fire({
                    icon: 'question',
                    title: 'Souhaitez-vous continuer',
                    text: "Vous êtes sur le point de refuser l'achat de l'article",
                    showConfirmButton: false,
                    showDenyButton: true,
                    showCancelButton: true,
                    denyButtonText: 'Refuser',
                    cancelButtonText: `Fermer`

                }).then(async (result) => {
                    if (result.isDenied) {
                        const { value: motif } = await swalWithBootstrapButtons.fire({
                            title: 'Motif de refus',
                            input: 'textarea',
                            // inputLabel: 'Motif de Refus',
                            inputPlaceholder: 'Veuillez saisir le motif de refus...',
                            inputAttributes: {
                                'aria-label': 'Veuillez saisir le motif de refus'
                            },
                            showCancelButton: true,
                            confirmButtonText: 'Supprimer',
                            cancelButtonText: 'Annuler',
                        })

                        if (motif) {
                            validateLignes(ids, 'refuse', motif);
                        }
                    }
                })
            });

            $('.btnRefuserSelected').click(function(){
                $invalid = $(this);
                ids = [];

                selected = $('#articleGrid').find('.checkArticle:checked');
                $.each(selected, function(){
                    ids.push($(this).data('id'))
                })

                swalWithBootstrapButtons.fire({
                    icon: 'question',
                    title: 'Souhaitez-vous continuer',
                    text: "Vous êtes sur le point de refuser l'achat des articles sélectionnés \n("+nbreselected+" art.)",
                    showConfirmButton: false,
                    showDenyButton: true,
                    showCancelButton: true,
                    denyButtonText: 'Refuser',
                    cancelButtonText: `Fermer`

                }).then(async (result) => {
                    if (result.isDenied) {
                        const { value: motif } = await swalWithBootstrapButtons.fire({
                            title: 'Motif de refus',
                            input: 'textarea',
                            // inputLabel: 'Motif de Refus',
                            inputPlaceholder: 'Veuillez saisir le motif de refus...',
                            inputAttributes: {
                                'aria-label': 'Veuillez saisir le motif de refus'
                            },
                            showCancelButton: true,
                            confirmButtonText: 'Supprimer',
                            cancelButtonText: 'Annuler',
                        })

                        if (motif) {
                            validateLignes(ids, 'refuse', motif);
                        }
                    }
                })
            });

            $('.btnAnnuler:first').click(function(){
                $cancel = $(this);
                swalWithBootstrapButtons.fire({
                    icon: 'question',
                    title: 'Souhaitez-vous continuer',
                    text: "Vous êtes sur le point d'annuler le bon d'expression de besoin",
                    showConfirmButton: false,
                    showDenyButton: true,
                    showCancelButton: true,
                    denyButtonText: 'Continuer',
                    cancelButtonText: `Fermer`

                }).then(async (result) => {
                    if (result.isDenied) {
                        window.location = $cancel.data('link') ;
                    }
                })
            });
        })
    })
</script>
@endsection
