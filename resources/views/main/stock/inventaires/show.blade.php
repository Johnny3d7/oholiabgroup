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
                        <h4 class="heading mb-3">Entrepot</h4>
                        <i class="i-Shop{{ $e <> 1 ? '-'.$e : '' }} text-{{ $color }} text-50 font-weight-500 d-block"></i>
                        <h5 class="mt-2 mb-3">{{ $inventaire->entrepot->name }}</h5>
                    </div>
                    <div class="col-md-6 col-lg-3 text-center pt-0">
                        <h4 class="heading mb-3">Entreprise</h4>
                        <img src="{{ asset($inventaire->entrepot->entreprise->logo) }}" class="pt-1" alt="" style="height: 4rem;">
                        <h5 class="mt-2 mb-3">{{ $inventaire->entrepot->entreprise->name }}</h5>
                    </div>
                    <div class="col-md-6 col-lg-4 text-center">
                        <h4 class="heading mb-3">{{ $inventaire->name }}</h4>
                        <h6>Inventoriste @if($inventaire->vs_inventoriste) <i class="i-Yes text-success"></i> @else <i class="i-Loading-3 text-info"></i> @endif</h6>
                        <h6>Comptable @if($inventaire->vs_comptable) <i class="i-Yes text-success"></i> @else <i class="i-Loading-3 text-info"></i> @endif</h6>
                        <h6>Chef comptable @if($inventaire->vs_chef_comptable) <i class="i-Yes text-success"></i> @else <i class="i-Loading-3 text-info"></i> @endif</h6>
                    </div>
                    <div class="form-group col-md-6 col-lg-2 pr-1 text-center">
                        <h4 class="heading mb-3">Date</h4>
                        <i class="i-Calendar-4 text-50 font-weight-500 d-block"></i>
                        <h5 class="mt-2 mb-3">{{ ucwords((new Carbon($inventaire->date_inventaire))->locale('fr')->isoFormat('DD/MM/YYYY')) }}</h5>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-12 text-center">
                        <h5>
                            <a href="" class="link-unstyled" data-target="#observation-box" data-toggle="collapse">
                                Observations <i class="fa fa-hand-o-left"></i>
                            </a>
                        </h5>
                        <div id="observation-box" class="border rounded collapse text-left p-3">
                            {!! $inventaire->observations ?? '<div class="text-center">Null</div>' !!}
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
                @switch($inventaire->statut)
                    @case(config('constants.statut.inventaires.effectue'))
                    <i class="i-Data-Yes text-50 text-primary mt-5"></i>
                    <h5 class="mt-2 text-primary">{{ ucfirst($inventaire->statut) }}</h5>
                        @break
                    @case(config('constants.statut.inventaires.valide'))
                    <i class="i-Yes text-50 text-success mt-5"></i>
                    <h5 class="mt-2 text-success">{{ ucfirst($inventaire->statut) }}</h5>
                        @break
                    @case('refusé')
                    <i class="i-Close text-50 text-danger"></i>
                    <h5 class="mt-2 text-danger">{{ ucfirst($inventaire->statut) }}</h5>
                        @break
                    @case('annulé')
                    <i class="i-Close text-50 text-warning"></i>
                    <h5 class="mt-2 text-warning">{{ ucfirst($inventaire->statut) }}</h5>
                    @break
                    @default
                    <i class="i-Loading-3 text-50 text-info mt-5"></i>
                    <h5 class="mt-2 text-info">{{ ucfirst($inventaire->statut) }}</h5>
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
                        <a href="{{ route('stock.inventaires.procede', $inventaire) }}" class="btn btn-lg btn-info ripple btn-block text-14 mb-3 pb-0">
                            <i class="d-block i-Big-Data text-30 pb-2"></i>
                            <p class="text-truncate" title="Renseigner l'inventaire">Renseigner l'inventaire</p>
                        </a>
                    @endif
                @endhasrole

                @hasrole(config('constants.roles.comptable') .'|'. config('constants.roles.geststock') .'|'. config('constants.roles.chefcomptable'))
                    @if ($inventaire->statut == config('constants.statut.inventaires.validation') && !$inventaire->{$actions[Auth::user()->role->name]})
                        <button class="btn btn-lg btn-success ripple btn-block text-14 mb-3 btnValider pb-0">
                            <i class="d-block i-Yes text-30 pb-2"></i>
                            <p class="text-truncate" title="Valider l'inventaire ">Valider l'inventaire </p>
                        </button>
                    @else
                        @if (Auth::user()->role->name == config('constants.roles.geststock') && $inventaire->statut == config('constants.statut.inventaires.valide'))
                            <h6 class="text-center">Aucune action disponible !</h6>
                            {{-- <button class="btn btn-lg btn-primary ripple btn-block text-14 mb-3 btnValider pb-0">
                                <i class="d-block i-Data-Transfer text-30 pb-2"></i>
                                <p class="text-truncate" title="Mettre à jour les stocks ">Mettre à jour les stocks </p>
                            </button> --}}
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
        <div class="col-md-6 col-lg-3 mt-4">
            <div class="card">
                <div id="articleRow-{{ $ligne->id }}" class="card-body articleRow p-0">
                    <div class="col-12 text-center p-0 rounded">
                        <a href="{{ route('stock.products.show', $product) }}" target="_blank" class="">
                            @if ($product->image) 
                                <img class="w-100 rounded-top" src="{{ asset($product->image) }}" alt="alt" />
                            @else
                                <img class="w-100 rounded-top" src="{{ url('images/product_picture.jpg') }}" alt="alt" />
                            @endif
                        </a>

                        <a href="{{ route('stock.products.show', $product) }}" target="_blank">
                            <p class="m-2 text-18 heading text-truncate" title="{{ $product->name }}">{{ $product->name }}</p>
                        </a>

                        <span class="rounded" style="position: absolute; top:1rem; right: 0rem; background-color: rgba(218, 201, 201, 0.5)"><img class="m-2" src="{{ asset($product->entreprise->logo) }}" alt="" style="height: 3rem;"></span>

                    </div>
                    <div class="col-12 text-center p-2">
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
                    <div class="p-2">
                        <div class="alert alert-{{ $ligne->statut == 'invalide' ? 'danger' : 'info' }} text-center m-0">
                            <h5>
                                <a href="" class="link-unstyled text-16 text-uppercase" data-target="#observation-{{ $ligne->id }}-box" data-toggle="collapse">
                                    {{ $ligne->statut }} <i class="fa fa-info-circle"></i>
                                </a>
                            </h5>
                            <div id="observation-{{ $ligne->id }}-box" class="border border-light rounded collapse text-left p-1 text-12">
                                {!! $ligne->observations ?? '<div class="text-center">Null</div>' !!}
                            </div>
                        </div>
                    </div>
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
