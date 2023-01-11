@extends('main.achats.partials.main')

@section('stylesheets')
<style>
    .card-icon-bg .card-body .content {
        max-width: 70%;
    }
</style>
@endsection

@section('menuTitle')
Gestions des achats
@endsection

@section('pageTitle')
Tableau de bord
@endsection

@section('content')
    <div class="row mb-4">
        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-icon-bg card-icon-bg-info o-hidden mb-4 hoverChange" data-color="info" data-link="{{ route('achats.besoins.index', ['target' => 'en attente']) }}">
                <div class="card-body text-center"><i class="i-Loading-3"></i>
                    <div class="content">
                        <p class="text-muted mt-2 mb-0">Fiches en attente</p>
                        <p class="text-primary text-24 line-height-1 mb-2">{{ $nbre->attente }}</p>
                    </div>
                </div>
                <div class="row bg-info pt-1"></div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-icon-bg card-icon-bg-success o-hidden mb-4 hoverChange" data-color="success" data-link="{{ route('achats.besoins.index', ['target' => 'validé']) }}">
                <div class="card-body text-center"><i class="i-Yes"></i>
                    <div class="content">
                        <p class="text-muted mt-2 mb-0">Fiches validées</p>
                        <p class="text-primary text-24 line-height-1 mb-2">{{ $nbre->valide }}</p>
                    </div>
                </div>
                <div class="row bg-success pt-1"></div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-icon-bg card-icon-bg-danger o-hidden mb-4 hoverChange" data-color="danger" data-link="{{ route('achats.besoins.index', ['target' => 'refusé']) }}">
                <div class="card-body text-center"><i class="i-Close"></i>
                    <div class="content">
                        <p class="text-muted mt-2 mb-0">Fiches refusées</p>
                        <p class="text-primary text-24 line-height-1 mb-2">{{ $nbre->refuse }}</p>
                    </div>
                </div>
                <div class="row bg-danger pt-1"></div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-icon-bg card-icon-bg-warning o-hidden mb-4 hoverChange" data-color="warning" data-link="{{ route('achats.besoins.index', ['target' => 'annulé']) }}">
                <div class="card-body text-center"><i class="i-Close"></i>
                    <div class="content">
                        <p class="text-muted mt-2 mb-0">Fiches annulées</p>
                        <p class="text-primary text-24 line-height-1 mb-2">{{ $nbre->annule }}</p>
                    </div>
                </div>
                <div class="row bg-warning pt-1"></div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-icon-bg card-icon-bg-primary o-hidden mb-4 hoverChange" data-color="primary" data-link="{{ route('achats.fournisseurs.index') }}">
                <div class="card-body text-center"><i class="i-Truck"></i>
                    <div class="content">
                        <p class="text-muted mt-2 mb-0">Fournisseurs</p>
                        <p class="text-primary text-24 line-height-1 mb-2">{{ $nbre->fournisseur }}</p>
                    </div>
                </div>
                <div class="row bg-primary pt-1"></div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-icon-bg card-icon-bg-primary o-hidden mb-4 hoverChange" data-color="primary">
                <div class="card-body text-center">
                    {{-- <i class="i-Store-2"></i> --}}
                    <div class="content">
                        <p class="text-muted mt-2 mb-0">Nbre de besoins par entreprise / mois</p>
                        {{-- <p class="text-primary text-24 line-height-1 mb-2">{{ $nbre->fournisseur }}</p> --}}
                    </div>
                </div>
                <div class="row bg-primary pt-1"></div>
            </div>
        </div>
        {{-- <div class="container">
            <div class="row">
            </div>
        </div> --}}
    </div>
@endsection

@section('javascripts')
<script>
    $(function(){
        $(document).ready(function(){
            $('.hoverChange').each(function(){
                $(this).css({'cursor':'pointer'});
                // $(this).removeClass('border border-'+$(this).data('color'))

                $(this).mouseenter(function(){
                    $(this).addClass('border border-'+$(this).data('color'))
                })
                $(this).mouseleave(function(){
                    $(this).removeClass('border border-'+$(this).data('color'))
                })
                $(this).click(function(){
                    if($(this).data('link')) window.location.href = $(this).data('link')
                })
            });

        })
    })
</script>
@endsection
