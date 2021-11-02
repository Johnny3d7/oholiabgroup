@extends('main.stock.partials.main')

@section('stylesheets')
@if ($commande->id_entreprise == 1)
<style>
    
b    #bl{
        background-repeat: no-repeat;
        background-position-x: center;
        background-position-y: center;
        background-image:url({{ url('images/faviconbrhxx.png') }}) ;
    }
</style>
@elseif($commande->id_entreprise == 2)
<style>
    #bl{
        background-repeat: no-repeat;
        background-position-x: center;
        background-position-y: center;
        background-image:url({{ url('images/totem_akebie.png') }}) ;
    }
</style>
@elseif($commande->id_entreprise == 3)
<style>
    .slogan{
       writing-mode: vertical-lr;
       
   }
   #bl{
       background-repeat: no-repeat;
       background-position-x: center;
       background-position-y: center;
       background-size: 25%;
       background-image:url({{ url('images/totem_obp.png') }}) ;
   }
  
</style>
@endif

@endsection

@section('menuTitle')
Bon de commande
@endsection

@section('pageTitle')
Affichage du bon de commande
@endsection

@section('content')
@if ($commande->id_entreprise == 1)
<div class="main-content pt-4">
    <div class="row">
        <div class="col-md-12">
            <ul class="nav nav-tabs justify-content-end mb-4" id="myTab" role="tablist">
                <li class="nav-item"><a class="nav-link active" id="invoice-tab" data-toggle="tab" href="#invoice" role="tab" aria-controls="invoice" aria-selected="true">Bon de commande</a></li>
                <li class="nav-item"><a class="nav-link" id="edit-tab" data-toggle="tab" href="#edit" role="tab" aria-controls="edit" aria-selected="false">Edit</a></li>
            </ul>
            <div class="card" id="bl">
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="invoice" role="tabpanel" aria-labelledby="invoice-tab">
                        <div class="d-sm-flex mb-5" data-view="print"><span class="m-auto"></span>
                            <button class="btn btn-primary mb-sm-0 mb-3 print-invoice btnblprint">Imprimer</button>
                        </div>
                        <!-- -===== Print Area =======-->
                        <div id="print-area">
                            <div class="row">
                                <div class="col-md-3">
                                    <img src="{{ url('images/rccm_logo_oholiab2.png') }}" alt="" >
                                </div>
                                <div class="col-md-9">
                                    <div class="row">
                                        <div class="col-md-7" style="border: 5px solid #332a6c; text-align:center; width:50% ">
                                            <strong style="color: #332a6c; font-size:32px; font-weight:800; font-family: Arial black !important;">BON DE COMMANDE</strong>    
                                        </div>
                                        <div class="col-md-5 mt-2" style="text-align:center">
                                            <strong style="color: #d40707; font-size:22px; font-weight:800; font-family: Arial black !important;">N° {{ $commande->num_cmd }}</strong>    
                                        </div>
                                        <div class="col-md-12 mt-5" style="color: #332a6c; font-family: Cambria !important;font-size:20px;">
                                            <div class="row">
                                                <div class="col-md-5 ">
                                                    
                                                    <p style="font-weight:600;">Date : {{ ucwords((new Carbon\Carbon($commande->created_at))->locale('fr')->isoFormat('DD/MM/YYYY')) }}</p>
                                                </div>
                                                <div class="col-md-6" style="border: 3px solid #332a6c;border-radius:30px;">
                                                    <p style="font-weight:300;">Fournisseur : {{ $commande->fournisseur->nom }}</p>
                                                    <p style="font-weight:300;">Adresse : {{ $commande->fournisseur->adresse }}</p>
                                                    <p style="font-weight:300;">Contact : +225 {{ $commande->fournisseur->contact }}</p>
                                                    <p style="font-weight:300;">N° CC : {{ $commande->fournisseur->ncc }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-3 mb-4 border-top"></div>
                            <div class="row" style="font-size:16px; ">
                                <div class="col-md-12 table-responsive">
                                    <table class="table table-hover mb-4">
                                        <thead class="" style="background-color : #332a6c; color:white">
                                            <tr>
                                                <th  scope="col">Réf.</th>
                                                <th  scope="col" >Désignation</th>
                                                <th  scope="col">Qté</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($commande->products as $data)
                                            @if ($data->pivot->status == 1)
                                                <tr>
                                                    <th scope="row">{{ $data->ref }}</th>
                                                    <td>{{ $data->lib }}</td>
                                                    <td>{{ $data->pivot->qte }}</td>
                            
                                                </tr>
                                            @endif
                                            
                                            @empty
                                                
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="row mb-5" style="font-size:16px; ">
                                <div class="col-md-6 text-center">
                                   <u>Signature de l'Administrateur Général</u>
                                </div>
                                <div class="col-md-6 text-center">
                                    <u>Signature de l'Administrateur de ventes</u>
                                </div>
                            </div>
                        </div>
                        <!-- ==== / Print Area =====-->
                    </div>
                   
                </div>
            </div>
        </div>
    </div><!-- end of main-content -->
</div>
@elseif($commande->id_entreprise == 2)
<div class="main-content pt-4">
    <div class="row">
        <div class="col-md-12">
            <ul class="nav nav-tabs justify-content-end mb-4" id="myTab" role="tablist">
                <li class="nav-item"><a class="nav-link active" id="invoice-tab" data-toggle="tab" href="#invoice" role="tab" aria-controls="invoice" aria-selected="true">Bon de commande</a></li>
                <li class="nav-item"><a class="nav-link" id="edit-tab" data-toggle="tab" href="#edit" role="tab" aria-controls="edit" aria-selected="false">Edit</a></li>
            </ul>
            <div class="card" id="bl">
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="invoice" role="tabpanel" aria-labelledby="invoice-tab">
                        <div class="d-sm-flex mb-5" data-view="print"><span class="m-auto"></span>
                            <button class="btn btn-primary mb-sm-0 mb-3 print-invoice btnblprint">Imprimer</button>
                        </div>
                        <!-- -===== Print Area =======-->
                        <div id="print-area">
                            <div class="row">
                                <div class="col-md-3">
                                    <img src="{{ url('images/rccm_logo_akebie.png') }}" alt="" >
                                </div>
                                <div class="col-md-9">
                                    <div class="row">
                                        <div class="col-md-7" style="border: 5px solid #8cbe22; text-align:center; width:50% ">
                                            <strong style="color: #8cbe22; font-size:32px; font-weight:800; font-family: Arial black !important;">BON DE COMMANDE</strong>    
                                        </div>
                                        <div class="col-md-5">
                                            <strong style="color: #d40707; font-size:22px; font-weight:800; font-family: Arial black !important;">N° {{ $commande->num_cmd }}</strong>    
                                        </div>
                                        <div class="col-md-12 mt-5" style="color: #332a6c; font-family: Cambria !important;font-size:20px;">
                                            <div class="row">
                                                <div class="col-md-5 ">
                                                    
                                                    <p style="font-weight:600;">Date : {{ ucwords((new Carbon\Carbon($commande->created_at))->locale('fr')->isoFormat('DD/MM/YYYY')) }}</p>
                                                </div>
                                                <div class="col-md-6" style="border: 3px solid #332a6c;border-radius:30px;">
                                                    <p style="font-weight:300;">Fournisseur : {{ $commande->fournisseur->nom }}</p>
                                                    <p style="font-weight:300;">Adresse : {{ $commande->fournisseur->adresse }}</p>
                                                    <p style="font-weight:300;">Contact : {{ $commande->fournisseur->contact }}</p>
                                                    <p style="font-weight:300;">N° CC : {{ $commande->fournisseur->ncc }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-3 mb-4 border-top"></div>
                            <div class="row" style="font-size:16px; ">
                                <div class="col-md-12 table-responsive">
                                    <table class="table table-hover mb-4">
                                        <thead class="" style="background-color : #8cbe22; color:white">
                                            <tr>
                                                <th  scope="col">Réf.</th>
                                                <th  scope="col" >Désignation</th>
                                                <th  scope="col">Qté</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($commande->products as $data)
                                            @if ($data->pivot->status == 1)
                                                <tr>
                                                    <th scope="row">{{ $data->ref }}</th>
                                                    <td>{{ $data->lib }}</td>
                                                    <td>{{ $data->pivot->qte }}</td>
                            
                                                </tr>
                                            @endif
                                            
                                            @empty
                                                
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="row mb-5" style="font-size:16px; ">
                                <div class="col-md-6 text-center">
                                   <u>Signature de l'Administrateur Général</u>
                                </div>
                                <div class="col-md-6 text-center">
                                    <u>Signature de l'Administrateur de ventes</u>
                                </div>
                            </div>
                        </div>
                        <!-- ==== / Print Area =====-->
                    </div>
                   
                </div>
            </div>
        </div>
    </div><!-- end of main-content -->
</div>
@elseif($commande->id_entreprise == 3)
<div class="main-content pt-4">
    <div class="row">
        <div class="col-md-12">
            <ul class="nav nav-tabs justify-content-end mb-4" id="myTab" role="tablist">
                <li class="nav-item"><a class="nav-link active" id="invoice-tab" data-toggle="tab" href="#invoice" role="tab" aria-controls="invoice" aria-selected="true">Bon de commande</a></li>
                <li class="nav-item"><a class="nav-link" id="edit-tab" data-toggle="tab" href="#edit" role="tab" aria-controls="edit" aria-selected="false">Edit</a></li>
            </ul>
            <div class="card" id="bl">
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="invoice" role="tabpanel" aria-labelledby="invoice-tab">
                        <div class="d-sm-flex mb-5" data-view="print"><span class="m-auto"></span>
                            <button class="btn btn-primary mb-sm-0 mb-3 print-invoice btnblprint">Imprimer</button>
                        </div>
                        <!-- -===== Print Area =======-->
                        <div id="print-area">
                            <div class="row">
                                <div class="col-md-3">
                                    <img src="{{ url('images/rccm_logo_obp.png') }}" alt="" >
                                </div>
                                <div class="col-md-9">
                                    <div class="row">
                                        <div class="col-md-7" style="border: 5px solid #0f70b7; text-align:center; width:50% ">
                                            <strong style="color: #0f70b7; font-size:32px; font-weight:800; font-family: Arial black !important;">BON DE COMMANDE</strong>    
                                        </div>
                                        <div class="col-md-5">
                                            <strong style="color: #d40707; font-size:22px; font-weight:800; font-family: Arial black !important;">N° {{ $commande->num_cmd }}</strong>    
                                        </div>
                                        <div class="col-md-12 mt-5" style="color: #332a6c; font-family: Cambria !important;font-size:20px;">
                                            <div class="row">
                                                <div class="col-md-5 ">
                                                    
                                                    <p style="font-weight:600;">Date : {{ ucwords((new Carbon\Carbon($commande->created_at))->locale('fr')->isoFormat('DD/MM/YYYY')) }}</p>
                                                </div>
                                                <div class="col-md-6" style="border: 3px solid #332a6c;border-radius:30px;">
                                                    <p style="font-weight:300;">Fournisseur : {{ $commande->fournisseur->nom }}</p>
                                                    <p style="font-weight:300;">Adresse : {{ $commande->fournisseur->adresse }}</p>
                                                    <p style="font-weight:300;">Contact : {{ $commande->fournisseur->contact }}</p>
                                                    <p style="font-weight:300;">N° CC : {{ $commande->fournisseur->ncc }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-3 mb-4 border-top"></div>
                            <div class="row" style="font-size:16px; ">
                                <div class="col-md-12 table-responsive">
                                    <table class="table table-hover mb-4">
                                        <thead class="" style="background-color : #0f70b7; color:white">
                                            <tr>
                                                <th  scope="col">Réf.</th>
                                                <th  scope="col" >Désignation</th>
                                                <th  scope="col">Qté</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($commande->products as $data)
                                            @if ($data->pivot->status == 1)
                                                <tr>
                                                    <th scope="row">{{ $data->ref }}</th>
                                                    <td>{{ $data->lib }}</td>
                                                    <td>{{ $data->pivot->qte }}</td>
                            
                                                </tr>
                                            @endif
                                            
                                            @empty
                                                
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="row mb-5" style="font-size:16px; ">
                                <div class="col-md-6 text-center">
                                   <u>Signature de l'Administrateur Général</u>
                                </div>
                                <div class="col-md-6 text-center">
                                    <u>Signature de l'Administrateur de ventes</u>
                                </div>
                            </div>
                        </div>
                        <!-- ==== / Print Area =====-->
                    </div>
                   
                </div>
            </div>
        </div>
    </div><!-- end of main-content -->
</div>
@endif

@endsection

@section('javascripts')
<script>
   $('.btnblprint').on('click', function() {
    window.print();
   });
</script>
@endsection