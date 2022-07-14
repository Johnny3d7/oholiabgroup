@php
    use Carbon\Carbon;

    $file = $facture->file ? asset($facture->file) : null;
@endphp

@extends('main.achats.partials.main')

@section('title', 'Détils de facture -')

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
Factures
@endsection

@section('pageTitle')
Détails de facture
@endsection

@section('content')
<div class="row">
    <div class="col-md-2 pb-2">
        <div class="card h-100">
            <div class="card-body text-center px-2">
                <h3 class="text-dark mb-3">Statut</h3>
                @switch($facture->statut)
                    @case('validé')
                    <i class="i-Yes text-78 text-success mt-5"></i>
                    <h3 class="text-info mt-2 text-success">{{ ucfirst($facture->statut) }}</h3>
                        @break
                    @case('refusé')
                    <i class="i-Close text-78 text-danger"></i>
                    <h3 class="text-info mt-2 text-danger">{{ ucfirst($facture->statut) }}</h3>
                        @break
                    @case('annulé')
                    <i class="i-Close text-78 text-warning"></i>
                    <h3 class="text-info mt-2 text-warning">{{ ucfirst($facture->statut) }}</h3>
                    @break
                    @default
                    <i class="i-Loading-3 text-78 text-info mt-5"></i>
                    <h3 class="text-info mt-2 text-info">{{ ucfirst($facture->statut) }}</h3>
                @endswitch
            </div>
        </div>
    </div>
    <div class="col-md-8 pb-2">
        <div class="card h-100">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-4 text-center p-5 pt-0">
                        <h3 class="text-dark mb-5">Fourisseur</h3>
                        <img src="{{ asset($facture->fournisseur->image) }}" class="pt-1" alt="" style="height: 5rem;">
                        <h3 class="mt-2">{{ $facture->fournisseur->name }}</h3>
                    </div>
                    <div class="col-lg-8">
                        <div class="ul-product-detail__brand-name mb-4">
                            <h2 class="heading text-uppercase">Facture {{ $facture->reference }}</h2>
                        </div>

                        <div class="ul-product-detail__features mt-4">
                            {{-- <h5 class="font-weight-700">Caractéristiques du besoin:</h5> --}}
                            <ul class="m-0 p-0">
                                <div class="ul-widget-app__browser-list-1 mb-2 mt-4">
                                    <i class="i-Spell-Check text-white teal-500 rounded-circle p-2 mr-3"></i>
                                    <span class="text-15"><strong>Montant Total :</strong> {{ number_format($facture->montant, 0, ',', ' ') }} F CFA </span>
                                    <span class="text-mute" style="display: none">2 April </span>
                                </div>
                                <div class="ul-widget-app__browser-list-1 mb-2">
                                    <i class="i-Spell-Check text-white teal-500 rounded-circle p-2 mr-3"></i>
                                    <span class="text-15"><strong>Date d'émission :</strong> {{ ucwords((new Carbon($facture->date_emission))->locale('fr')->isoFormat('DD/MM/YYYY')) }} </span>
                                    <span class="text-mute" style="display: none">2 April </span>
                                </div>
                                <div class="ul-widget-app__browser-list-1 mb-2 ">
                                    <i class="i-Spell-Check text-white teal-500 rounded-circle p-2 mr-3"></i>
                                    <span class="text-15"><strong>Observations :</strong></span>
                                    <span class="text-mute" style="display: none">2 April </span>
                                </div>
                                <p style="max-height: 5rem; overflow-x: auto;">
                                    {{ $facture->description }}
                                </p>
                            </ul>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-2 pb-2">
        <div class="card h-100">
            <div class="card-body text-center">
                <h3 class="text-dark mb-4">Actions</h3>
                @role('Directrice Générale')
                    @if (in_array($facture->statut, ['validé', 'refusé', 'annulé']))
                        <button type="button" data-link="{{ route('achats.besoins.validation', ['besoin' => $facture, 'statut' => 'valide']) }}" class="btn btn-lg btn-success ripple btn-block text-16 mb-3 btnValider">
                            <i class="i-Yes text-30"></i>
                            <span class="d-block">Valider</span>
                        </button>
                        <button type="button" data-link="{{ route('achats.besoins.validation', ['besoin' => $facture, 'statut' => 'invalide']) }}" class="btn btn-lg btn-danger ripple btn-block text-16 btnRefuser">
                            <i class="i-Close text-30"></i>
                            <span class="d-block">Refuser</span>
                        </button>
                    @else
                        <h6 class="text-center">Aucune action disponible !</h6>
                    @endif
                @endrole

                @role("Chargé d'Achats")
                    @if (in_array($facture->statut, ['en attente', 'refusé', 'annulé']))
                        <a href="{{ route('achats.besoins.edit', $facture) }}" class="btn btn-md btn-success ripple btn-block text-16 mb-3">
                            <i class="i-Pen-4 text-30"></i>
                            <span class="d-block">Editer</span>
                        </a>
                        @if ($facture->statut == 'en attente')
                            <button type="button" data-link="{{ route('achats.besoins.validation', ['besoin' => $facture, 'statut' => 'annulé']) }}" class="btn btn-md btn-warning ripple btn-block text-16 mb-3 btnAnnuler">
                                <i class="i-Close text-30"></i>
                                <span class="d-block">Annuler</span>
                            </button>
                        @endif
                    @else
                        @if ($facture->statut == 'validé')
                            <a href="{{ route('achats.besoins.edit', $facture) }}" class="btn btn-md btn-info ripple btn-block text-16 mb-3">
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

@if ($facture->file)
    @php
        $file = new \Symfony\Component\HttpFoundation\File\File($facture->file);
        $ext = $file ? $file->getExtension() : null;
    @endphp
    <div class="row">
        <div class="container-fluid mt-4">
            <div class="card">
                <div class="card-body">
                    {{-- <img src="{{ asset($facture->file) }}" class="w-100" alt="">
                    {{ $file }} --}}
                    {{-- <div id="pspdfkit" style="width: 100%; height: 100vh;"></div> --}}

                    @if ($ext)
                        {{-- <div id="loader-pre-pdf" class="spinner spinner-primary mr-3" style="position: absolute; left: 50%; top: 50%;"></div> --}}
                        @if ($ext == "pdf")
                            <div style="width: 100%; height: 100vh;">
                                <object
                                    data='{{ asset($facture->file) }}'
                                    type="application/pdf"
                                    width="100%"
                                    height="100%"
                                >

                                    <iframe
                                    src='{{ asset($facture->file) }}'
                                    width="100%"
                                    height="100%"
                                    >
                                    <p>This browser does not support PDF!</p>
                                    </iframe>
                                </object>
                            </div>
                        @else
                            <img src="{{ asset($facture->file) }}" class="w-100" alt="">
                        @endif
                    @else

                    @endif

                </div>
            </div>
        </div>
    </div>

@endif

@endsection

@section('javascripts')
{{-- <script src="{{ asset('myplugins/PSPDFKit/modern/pspdfkit.js') }}"></script> --}}
<script src="{{ asset('myplugins/PSPDFKit/pspdfkit.js') }}"></script>
<script>
    $(function(){
        $(document).ready(function(){
            var document = "{{ asset($facture->file) }}";
            PSPDFKit.load({
                container: '#pspdfkit',
                document: document,
            })
            .then(function (instance) {
                $('#loader-pre-pdf').addClass('d-none');
                console.log('PSPDFKit loaded', instance);
            })
            .catch(function (error) {
                $('#loader-pre-pdf').addClass('d-none');
                console.error(error.message);
            });
        })
    })
</script>
@endsection
