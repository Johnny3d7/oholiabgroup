@php
    use Carbon\Carbon;
@endphp

@extends('main.stock.partials.main')

@section('title', "Détals d'un inventaires -")

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
Inventaire
@endsection

@section('pageTitle')
Détails d'un inventaire
@endsection

@section('content')
<div class="row">
    <div class="col-md-12 col-lg-8 pb-2">
        <div class="card h-100">
            <div class="card-body">
                <div class="row">
                    @php
                        $e = $inventaire->entrepot->entreprise->id;
                        $color = ($e == 1) ? 'success' : (($e == 2) ? 'info' : (($e == 3) ? 'primary' : ''));
                    @endphp
                    <div class="col-md-6 col-lg-3 text-center pt-0">
                        <h3 class="heading mb-4">Entrepot</h3>
                        <i class="i-Shop{{ $e <> 1 ? '-'.$e : '' }} text-{{ $color }} text-50 font-weight-500 d-block"></i>
                        <h3 class="mt-2 mb-3">{{ $inventaire->entrepot->name }}</h3>
                    </div>
                    <div class="col-md-6 col-lg-2 text-center pt-0">
                        <h3 class="heading mb-4">Entreprise</h3>
                        <img src="{{ asset($inventaire->entrepot->entreprise->logo) }}" class="pt-1" alt="" style="height: 4rem;">
                        <h3 class="mt-2 mb-3">{{ $inventaire->entrepot->entreprise->name }}</h3>
                    </div>
                    <div class="col-md-6 col-lg-5 text-center">
                        <h3 class="heading">{{ $inventaire->name }}</h3>
                        <h6>{{ $inventaire->observations }}</h6>
                        <h5 class="heading">Validations</h5>
                        <h6>Inventoriste @if($inventaire->vs_inventoriste) <i class="i-Yes text-success"></i> @else <i class="i-Loading-3 text-info"></i> @endif</h6>
                        <h6>Comptable @if($inventaire->vs_comptable) <i class="i-Yes text-success"></i> @else <i class="i-Loading-3 text-info"></i> @endif</h6>
                        <h6>Chef comptable @if($inventaire->vs_chef_comptable) <i class="i-Yes text-success"></i> @else <i class="i-Loading-3 text-info"></i> @endif</h6>
                    </div>
                    <div class="form-group col-md-6 col-lg-2 pr-2 text-center">
                        <h3 class="heading mb-4">Date Inventaire</h3>
                        <i class="i-Calendar-4 text-50 font-weight-500 d-block"></i>
                        <h3 class="mt-2 mb-3">{{ ucwords((new Carbon($inventaire->date_inventaire))->locale('fr')->isoFormat('DD/MM/YYYY')) }}</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-2 pb-2">
        <div class="card h-100">
            <div class="card-body text-center px-2">
                <h3 class="text-dark mb-3">Statut</h3>
                @switch($inventaire->statut)
                    @case(config('constants.statut.inventaires.effectue'))
                    <i class="i-Data-Yes text-78 text-primary mt-5"></i>
                    <h3 class="mt-2 text-primary">{{ ucfirst($inventaire->statut) }}</h3>
                        @break
                    @case(config('constants.statut.inventaires.valide'))
                    <i class="i-Yes text-78 text-success mt-5"></i>
                    <h3 class="mt-2 text-success">{{ ucfirst($inventaire->statut) }}</h3>
                        @break
                    @case('refusé')
                    <i class="i-Close text-78 text-danger"></i>
                    <h3 class="mt-2 text-danger">{{ ucfirst($inventaire->statut) }}</h3>
                        @break
                    @case('annulé')
                    <i class="i-Close text-78 text-warning"></i>
                    <h3 class="mt-2 text-warning">{{ ucfirst($inventaire->statut) }}</h3>
                    @break
                    @default
                    <i class="i-Loading-3 text-78 text-info mt-5"></i>
                    <h3 class="mt-2 text-info">{{ ucfirst($inventaire->statut) }}</h3>
                @endswitch
                @if ($inventaire->statut == 'refusé')
                    <div class="alert alert-danger h5">{{ $inventaire->motif }}</div>
                @endif
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-2 pb-2">
        <div class="card h-100">
            <div class="card-body text-center">
                <h3 class="text-dark mb-4">Actions</h3>

                @php
                    $actions = [
                        config('constants.roles.geststock') => 'vs_inventoriste',
                        config('constants.roles.comptable') => 'vs_comptable',
                        config('constants.roles.chefcomptable') => 'vs_chef_comptable',
                    ];
                @endphp

                @hasrole(config('constants.roles.geststock'))
                    @if (!in_array($inventaire->statut, [config('constants.statut.inventaires.valide'), config('constants.statut.inventaires.validation')]))
                        <a href="{{ route('stock.inventaires.procede', $inventaire) }}" class="btn btn-lg btn-info ripple btn-block text-16 mb-3">
                            <i class="i-Big-Data text-30"></i>
                            <span class="d-block">Procéder à l'inventaire </span>
                        </a>
                    @endif
                @endhasrole

                @hasrole(config('constants.roles.comptable') .'|'. config('constants.roles.geststock') .'|'. config('constants.roles.chefcomptable'))
                    @if ($inventaire->statut == config('constants.statut.inventaires.validation') && !$inventaire->{$actions[Auth::user()->role->name]})
                        <button class="btn btn-lg btn-success ripple btn-block text-16 mb-3 btnValider">
                            <i class="i-Yes text-30"></i>
                            <span class="d-block">Valider l'inventaire </span>
                        </button>
                    @else
                        @if (Auth::user()->role->name == config('constants.roles.geststock') && $inventaire->statut == config('constants.statut.inventaires.valide'))
                            <button class="btn btn-lg btn-primary ripple btn-block text-16 mb-3 btnValider">
                                <i class="i-Data-Transfer text-30"></i>
                                <span class="d-block">Mettre à jour les stocks </span>
                            </button>
                        @else
                            <h6 class="text-center">Aucune action disponible !</h6>
                        @endif
                    @endif
                @endhasrole


            </div>
        </div>
    </div>
</div>

<div class="row" id="articleGrid">
    @foreach ($inventaire->lignes as $ligne)
        @php
            $product = $ligne->product;
        @endphp
        <div class="col-md-6 col-lg-4 mt-4">
            <div class="card">
                <div id="articleRow-{{ $ligne->id }}" class="card-body articleRow">

                    <div class="user-profile mb-4">
                        <div class="ul-widget-card__user-info row">
                            @role(config('constants.roles.chgachat'))
                                @if (in_array($inventaire->statut, ['en attente' /*, 'refusé', 'annulé' */]))
                                    <a href="javascript:void(0);" data-toggle="modal" data-target="#edit_{{ $ligne->uuid }}_modal" class="btn btn-md btn-outline-success ripple text-16 mb-3" style="position: absolute; top:0.2rem; right: 0.2rem; z-index: 1000;">
                                        <i class="i-Pen-4 text-20"></i>
                                    </a>
                                        {{-- <span class="d-block">Editer</span>  --}}
                                @endif
                            @endrole
                            @role(config('constants.roles.dg'))
                                @if ($ligne->statut == 'en attente')
                                    <label class="checkbox checkbox-info">
                                        <input class="checkArticle" data-id={{ $ligne->id }} type="checkbox" checked="checked">
                                        <span class="checkmark" style="position: absolute; top:-3rem; left: 0; z-index: 1000; width: 30px; height: 30px;"></span>
                                    </label>
                                @endif
                            @endrole
                            <div class="col-md-4 border-md-right">
                                {{-- <div class="diagonal text-uppercase badge red-300" style="width: 10rem; transform: rotate(-45deg) translate(-37%, 0); position: absolute; top:-15px; left:5px;">
                                    <h6>{{ $ligne->statut }}</h6>
                                </div> --}}
                                <div class="ul-product-detail--icon mb-2">
                                    <a href="{{ route('stock.products.show', $product) }}" target="_blank">
                                        <img class="w-100 p-1 rounded-cir" src="{{ asset($product->image) }}" alt="">
                                    </a>
                                </div>
                            </div>
                            <div class="col-md">
                                <a href="{{ route('stock.products.show', $product) }}" target="_blank">
                                    <p class="m-0 text-18 heading">{{ $product->name }}</p>
                                </a>
                                <h3 class="pt-3">
                                    <div class="text-muted h5">Quantité Attendue</div>
                                    <div>
                                        {{ number_format($ligne->qte_att, 0, ',', ' ') }}
                                    </div>
                                </h3>
                                <h3>
                                    <div class="text-muted h5">Quantité Réelle</div>
                                    <div>
                                        {{ number_format($ligne->qte_res, 0, ',', ' ') }}
                                    </div>
                                </h3>
                            </div>
                            <div class="container-fluid">
                                <h6>{{ $ligne->observations }}</h6>
                            </div>
                        </div>
                        <div class="alert alert-{{ $ligne->statut == 'invalide' ? 'danger' : 'info' }} text-center text-16 text-uppercase">{{ $ligne->statut }} </div>
                    </div>
                    @role(config('constants.roles.dg'))
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
                    @role(config('constants.roles.chgachat'))
                        @switch($ligne->statut)
                            @case('validé')
                                <div class="pt-2 px-md-2 text-center">
                                    <a href="{{ route('achats.ligne_factures.create', ['ligne'=>$ligne]) }}" class="btn btn-md btn-info btn-block text-18">
                                        <i class="i-Shopping-Cart text-18"></i>
                                        <span>Procéder à l'achat</span>
                                    </a>
                                </div>
                                @break
                            @case(2)
                                <div class="alert alert-{{ $ligne->statut == 'refusé' ? 'danger' : 'info' }} text-center text-16 text-uppercase mb-0">{{ $ligne->statut }}{{ $ligne->motif ? ' : '.$ligne->motif  : '' }} </div>
                                @break
                            @default
                                <div class="alert alert-{{ $ligne->statut == 'refusé' ? 'danger' : 'info' }} text-center text-16 text-uppercase mb-0">{{ $ligne->statut }}{{ $ligne->motif ? ' : '.$ligne->motif  : '' }} </div>
                        @endswitch
                    @endrole
                </div>
            </div>
        </div>
        @role(config('constants.roles.chgachat'))
            @if (in_array($inventaire->statut, ['en attente', 'refusé', 'annulé']))
                @include('main.achats.besoins._editLigne')
            @endif
        @endrole
    @endforeach
</div>

@endsection

@section('javascripts')
<script>
    $(function(){
        $(document).ready(function(){
            function validate (statut, motif = null){
                HoldOn.open({
                    theme:"sk-circle"
                });

                $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
                $.ajax({
                    method: "POST",
                    url: "{{ route('stock.inventaires.validation', $inventaire) }}",
                    data:{
                        'api':'true',
                        'statut':statut,
                        'motif':motif
                    },
                    success : function( msg ) {
                        Toast.fire({
                            'icon': 'success',
                            'title': msg.msg
                        })
                        HoldOn.close();
                        setTimeout(() => {
                            window.location.reload()
                        }, 1000);
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

            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-lg btn-success mx-1',
                    denyButton: 'btn btn-lg btn-danger mx-1',
                    cancelButton: 'btn btn-lg btn-secondary mx-1',
                },
                buttonsStyling: false
            });

            $('.btnValider').click(function(){
                $valid = $(this);
                ids = [];

                selected = $('#articleGrid').find('.checkArticle:checked');
                $.each(selected, function(){
                    ids.push($(this).data('id'))
                })

                swalWithBootstrapButtons.fire({
                    icon: 'question',
                    title: 'Souhaitez-vous continuer',
                    text: "Vous êtes sur le point de valider l'inventaire",
                    showCancelButton: true,
                    confirmButtonText: 'Valider',
                    cancelButtonText: `Annuler`

                }).then((result) => {
                    /* Read more about isConfirmed, isDenied below */
                    if(result.isConfirmed){
                        validate('valide')
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
                            validate('refuse', motif);
                        }
                    }
                })
            });

        })
    })
</script>
@endsection
