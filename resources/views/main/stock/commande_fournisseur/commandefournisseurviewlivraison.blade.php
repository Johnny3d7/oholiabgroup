@extends('main.stock.partials.main')

@section('stylesheets')
@if ($commande->id_fournisseur == 1)
<style>
    
    #bl{
        background-repeat: no-repeat;
        background-position-x: center;
        background-position-y: center;
        background-image:url({{ url('images/faviconbrhxx.png') }}) ;
    }
</style>
@elseif($commande->id_fournisseur == 2)
<style>
    #bl{
        background-repeat: no-repeat;
        background-position-x: center;
        background-position-y: center;
        background-image:url({{ url('images/totem_akebie.png') }}) ;
    }
</style>
@elseif($commande->id_fournisseur == 3)
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
Bon de livraison
@endsection

@section('pageTitle')
Affichage du bon de livraison
@endsection

@section('content')
@if ($commande->id_fournisseur == 1)
<div class="main-content pt-4">
    <div class="row">
        <div class="col-md-12">
            <ul class="nav nav-tabs justify-content-end mb-4" id="myTab" role="tablist">
                <li class="nav-item"><a class="nav-link active" id="invoice-tab" data-toggle="tab" href="#invoice" role="tab" aria-controls="invoice" aria-selected="true">Bon de livraison</a></li>
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
                                            <strong style="color: #332a6c; font-size:32px; font-weight:800; font-family: Arial black !important;">BON DE LIVRAISON</strong>    
                                        </div>
                                        <div class="col-md-5 mt-2" style="text-align: center">
                                            <strong style="color: #d40707; font-size:22px; font-weight:800; font-family: Arial black !important;">N?? {{ $commande->livraisons->first()->num_bl }}</strong>    
                                        </div>
                                        <div class="col-md-12 mt-5" style="color: #332a6c; font-family: Cambria !important;font-size:20px;">
                                            <div class="row">
                                                <div class="col-md-6 ">
                                                    <p style="font-weight:300;">N?? Client : {{ $commande->entreprise->id }}</p>
                                                    <p style="font-weight:300;">N?? Compte Contribuable : {{ $commande->entreprise->ncc }}</p>
                                                    <p style="font-weight:300;">Code commercial :.......................</p>
                                                </div>
                                                <div class="col-md-5" style="border: 3px solid #332a6c;border-radius:30px;">
                                                    <p style="font-weight:300;">Client : {{ $commande->entreprise->nom }}</p>
                                                    <p style="font-weight:300;">Adresse : {{ $commande->entreprise->adresse }}</p>
                                                    <p style="font-weight:300;">Contact : +225 {{ $commande->entreprise->contact }}</p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12 ">
                                                    <p style="font-weight:600;">Date : {{ ucwords((new Carbon\Carbon($commande->livraisons->first()->created_at))->locale('fr')->isoFormat('DD/MM/YYYY')) }}</p>   
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
                                                <th  scope="col">R??f.</th>
                                                <th  scope="col" >D??signation</th>
                                                <th  scope="col">Qt??</th>
                                                <th  scope="col">Num??ro S??rie</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($commande->products as $data)
                                            @if ($data->pivot->status == 1)
                                                <tr>
                                                    <th scope="row">{{ $data->ref }}</th>
                                                    <td>{{ $data->lib }}</td>
                                                    <td>{{ $data->pivot->qte }}</td>
                                                    <td></td>
                            
                                                </tr>
                                            @endif
                                            
                                            @empty
                                                
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="row" style="font-size:16px; ">
                                <div class="col-md-12 table-responsive">
                                    <table class="table table-hover mb-4">
                                        <thead class="" style="background-color : #332a6c; color:white">
                                            <tr>
                                                <th scope="col">Client</th>
                                                <th scope="col">Livreur</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td scope="row">
                                                    <p>Date de r??ception : </p>
                                                    <p>Nom et pr??nom(s) : </p>
                                                    <p class="mt-5 mb-5"><strong>Visa</strong> </p>
                                                </td>
                                                <td>
                                                    <p>Date de r??ception : {{ ucwords((new Carbon\Carbon($commande->livraisons->first()->created_at))->locale('fr')->isoFormat('DD/MM/YYYY')) }}</p>
                                                    <p>Nom et pr??nom(s) : {{ $commande->livraisons->first()->livreur->nom }}</p>
                                                    <p class="mt-5 mb-5"><strong>Visa</strong> </p>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!-- ==== / Print Area =====-->
                    </div>
                    <div class="tab-pane fade" id="edit" role="tabpanel" aria-labelledby="edit-tab">
                        <!-- ==== Edit Area =====-->
                        <div class="d-flex mb-5"><span class="m-auto"></span>
                            <button class="btn btn-primary">Save</button>
                        </div>
                        <form>
                            <div class="row justify-content-between">
                                <div class="col-md-6">
                                    <h4 class="font-weight-bold">Order Info</h4>
                                    <div class="col-sm-4 form-group mb-3 pl-0">
                                        <label for="orderNo">Order Number</label>
                                        <input class="form-control" id="orderNo" type="text" placeholder="Enter order number" />
                                    </div>
                                </div>
                                <div class="col-md-3 text-right">
                                    <label class="d-block text-12 text-muted">Order Status</label>
                                    <div class="pr-0 mb-4">
                                        <label class="radio radio-reverse radio-danger">
                                            <input type="radio" name="orderStatus" value="Pending" /><span>Pending</span><span class="checkmark"></span>
                                        </label>
                                        <label class="radio radio-reverse radio-warning">
                                            <input type="radio" name="orderStatus" value="Processing" /><span>Processing</span><span class="checkmark"></span>
                                        </label>
                                        <label class="radio radio-reverse radio-success">
                                            <input type="radio" name="orderStatus" value="Delivered" /><span>Delivered</span><span class="checkmark"></span>
                                        </label>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="order-datepicker">Order Date</label>
                                        <input class="form-control text-right" id="order-datepicker" placeholder="yyyy-mm-dd" name="dp" />
                                    </div>
                                </div>
                            </div>
                            <div class="mt-3 mb-4 border-top"></div>
                            <div class="row mb-5">
                                <div class="col-md-6">
                                    <h5 class="font-weight-bold">Bill From</h5>
                                    <div class="col-md-10 form-group mb-3 pl-0">
                                        <input class="form-control" id="billFrom3" type="text" placeholder="Bill From" />
                                    </div>
                                    <div class="col-md-10 form-group mb-3 pl-0">
                                        <textarea class="form-control" placeholder="Bill From Address"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-6 text-right">
                                    <h5 class="font-weight-bold">Bill To</h5>
                                    <div class="col-md-10 offset-md-2 form-group mb-3 pr-0">
                                        <input class="form-control text-right" id="billFrom2" type="text" placeholder="Bill From" />
                                    </div>
                                    <div class="col-md-10 offset-md-2 form-group mb-3 pr-0">
                                        <textarea class="form-control text-right" placeholder="Bill From Address"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 table-responsive">
                                    <table class="table table-hover mb-3">
                                        <thead class="bg-gray-300">
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Item Name</th>
                                                <th scope="col">Unit Price</th>
                                                <th scope="col">Unit</th>
                                                <th scope="col">Cost</th>
                                                <th scope="col"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <th scope="row">1</th>
                                                <td>
                                                    <input class="form-control" value="Product 1" type="text" placeholder="Item Name" />
                                                </td>
                                                <td>
                                                    <input class="form-control" value="300" type="number" placeholder="Unit Price" />
                                                </td>
                                                <td>
                                                    <input class="form-control" value="2" type="number" placeholder="Unit" />
                                                </td>
                                                <td>600</td>
                                                <td>
                                                    <button class="btn btn-outline-secondary float-right">Delete</button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row">2</th>
                                                <td>
                                                    <input class="form-control" value="Product 1" type="text" placeholder="Item Name" />
                                                </td>
                                                <td>
                                                    <input class="form-control" value="300" type="number" placeholder="Unit Price" />
                                                </td>
                                                <td>
                                                    <input class="form-control" value="2" type="number" placeholder="Unit" />
                                                </td>
                                                <td>600</td>
                                                <td>
                                                    <button class="btn btn-outline-secondary float-right">Delete</button>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <button class="btn btn-primary float-right mb-4">Add Item</button>
                                </div>
                                <div class="col-md-12">
                                    <div class="invoice-summary invoice-summary-input float-right">
                                        <p>Sub total: <span>$1200</span></p>
                                        <p class="d-flex align-items-center">Vat(%):<span>
                                                <input class="form-control small-input" type="text" value="10" />$120</span></p>
                                        <h5 class="font-weight-bold d-flex align-items-center">Grand Total:<span>
                                                <input class="form-control small-input" type="text" value="$" />$1320</span></h5>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <!-- ==== / Edit Area =====-->
                    </div>
                </div>
            </div>
        </div>
    </div><!-- end of main-content -->
</div>
@elseif($commande->id_fournisseur == 2)
<div class="main-content pt-4">
    <div class="row">
        <div class="col-md-12">
            <ul class="nav nav-tabs justify-content-end mb-4" id="myTab" role="tablist">
                <li class="nav-item"><a class="nav-link active" id="invoice-tab" data-toggle="tab" href="#invoice" role="tab" aria-controls="invoice" aria-selected="true">Bon de livraison</a></li>
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
                                            <strong style="color: #8cbe22; font-size:32px; font-weight:800; font-family: Arial black !important;">BON DE LIVRAISON</strong>    
                                        </div>
                                        <div class="col-md-5 mt-2" style="text-align: center">
                                            <strong style="color: #d40707; font-size:22px; font-weight:800; font-family: Arial black !important;">N?? {{ $commande->livraisons->first()->num_bl }}</strong>    
                                        </div>
                                        <div class="col-md-12 mt-5" style="color: #332a6c; font-family: Cambria !important;font-size:20px;">
                                            <div class="row">
                                                <div class="col-md-6 ">
                                                    <p style="font-weight:300;">N?? Client : {{ $commande->entreprise->id }}</p>
                                                    <p style="font-weight:300;">N?? Compte Contribuable : {{ $commande->entreprise->ncc }}</p>
                                                    <p style="font-weight:300;">Code commercial :.......................</p>
                                                </div>
                                                <div class="col-md-5" style="border: 3px solid #332a6c;border-radius:30px;">
                                                    <p style="font-weight:300;">Client : {{ $commande->entreprise->nom }}</p>
                                                    <p style="font-weight:300;">Adresse : {{ $commande->entreprise->adresse }}</p>
                                                    <p style="font-weight:300;">Contact : +225 {{ $commande->entreprise->contact }}</p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12 ">
                                                    <p style="font-weight:600;">Date : {{ ucwords((new Carbon\Carbon($commande->livraisons->first()->created_at))->locale('fr')->isoFormat('DD/MM/YYYY')) }}</p>   
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
                                                <th  scope="col">R??f.</th>
                                                <th  scope="col" >D??signation</th>
                                                <th  scope="col">Qt??</th>
                                                <th  scope="col">Num??ro S??rie</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($commande->products as $data)
                                            @if ($data->pivot->status == 1)
                                                <tr>
                                                    <th scope="row">{{ $data->ref }}</th>
                                                    <td>{{ $data->lib }}</td>
                                                    <td>{{ $data->pivot->qte }}</td>
                                                    <td></td>
                            
                                                </tr>
                                            @endif
                                            
                                            @empty
                                                
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="row" style="font-size:16px; ">
                                <div class="col-md-12 table-responsive">
                                    <table class="table table-hover mb-4">
                                        <thead class="" style="background-color : #8cbe22; color:white">
                                            <tr>
                                                <th scope="col">Client</th>
                                                <th scope="col">Livreur</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td scope="row">
                                                    <p>Date de r??ception : </p>
                                                    <p>Nom et pr??nom(s) : </p>
                                                    <p class="mt-5 mb-5"><strong>Visa</strong> </p>
                                                </td>
                                                <td>
                                                    <p>Date de r??ception : {{ ucwords((new Carbon\Carbon($commande->livraisons->first()->created_at))->locale('fr')->isoFormat('DD/MM/YYYY')) }}</p>
                                                    <p>Nom et pr??nom(s) : {{ $commande->livraisons->first()->livreur->nom }}</p>
                                                    <p class="mt-5 mb-5"><strong>Visa</strong> </p>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!-- ==== / Print Area =====-->
                    </div>
                    <div class="tab-pane fade" id="edit" role="tabpanel" aria-labelledby="edit-tab">
                        <!-- ==== Edit Area =====-->
                        <div class="d-flex mb-5"><span class="m-auto"></span>
                            <button class="btn btn-primary">Save</button>
                        </div>
                        <form>
                            <div class="row justify-content-between">
                                <div class="col-md-6">
                                    <h4 class="font-weight-bold">Order Info</h4>
                                    <div class="col-sm-4 form-group mb-3 pl-0">
                                        <label for="orderNo">Order Number</label>
                                        <input class="form-control" id="orderNo" type="text" placeholder="Enter order number" />
                                    </div>
                                </div>
                                <div class="col-md-3 text-right">
                                    <label class="d-block text-12 text-muted">Order Status</label>
                                    <div class="pr-0 mb-4">
                                        <label class="radio radio-reverse radio-danger">
                                            <input type="radio" name="orderStatus" value="Pending" /><span>Pending</span><span class="checkmark"></span>
                                        </label>
                                        <label class="radio radio-reverse radio-warning">
                                            <input type="radio" name="orderStatus" value="Processing" /><span>Processing</span><span class="checkmark"></span>
                                        </label>
                                        <label class="radio radio-reverse radio-success">
                                            <input type="radio" name="orderStatus" value="Delivered" /><span>Delivered</span><span class="checkmark"></span>
                                        </label>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="order-datepicker">Order Date</label>
                                        <input class="form-control text-right" id="order-datepicker" placeholder="yyyy-mm-dd" name="dp" />
                                    </div>
                                </div>
                            </div>
                            <div class="mt-3 mb-4 border-top"></div>
                            <div class="row mb-5">
                                <div class="col-md-6">
                                    <h5 class="font-weight-bold">Bill From</h5>
                                    <div class="col-md-10 form-group mb-3 pl-0">
                                        <input class="form-control" id="billFrom3" type="text" placeholder="Bill From" />
                                    </div>
                                    <div class="col-md-10 form-group mb-3 pl-0">
                                        <textarea class="form-control" placeholder="Bill From Address"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-6 text-right">
                                    <h5 class="font-weight-bold">Bill To</h5>
                                    <div class="col-md-10 offset-md-2 form-group mb-3 pr-0">
                                        <input class="form-control text-right" id="billFrom2" type="text" placeholder="Bill From" />
                                    </div>
                                    <div class="col-md-10 offset-md-2 form-group mb-3 pr-0">
                                        <textarea class="form-control text-right" placeholder="Bill From Address"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 table-responsive">
                                    <table class="table table-hover mb-3">
                                        <thead class="bg-gray-300">
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Item Name</th>
                                                <th scope="col">Unit Price</th>
                                                <th scope="col">Unit</th>
                                                <th scope="col">Cost</th>
                                                <th scope="col"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <th scope="row">1</th>
                                                <td>
                                                    <input class="form-control" value="Product 1" type="text" placeholder="Item Name" />
                                                </td>
                                                <td>
                                                    <input class="form-control" value="300" type="number" placeholder="Unit Price" />
                                                </td>
                                                <td>
                                                    <input class="form-control" value="2" type="number" placeholder="Unit" />
                                                </td>
                                                <td>600</td>
                                                <td>
                                                    <button class="btn btn-outline-secondary float-right">Delete</button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row">2</th>
                                                <td>
                                                    <input class="form-control" value="Product 1" type="text" placeholder="Item Name" />
                                                </td>
                                                <td>
                                                    <input class="form-control" value="300" type="number" placeholder="Unit Price" />
                                                </td>
                                                <td>
                                                    <input class="form-control" value="2" type="number" placeholder="Unit" />
                                                </td>
                                                <td>600</td>
                                                <td>
                                                    <button class="btn btn-outline-secondary float-right">Delete</button>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <button class="btn btn-primary float-right mb-4">Add Item</button>
                                </div>
                                <div class="col-md-12">
                                    <div class="invoice-summary invoice-summary-input float-right">
                                        <p>Sub total: <span>$1200</span></p>
                                        <p class="d-flex align-items-center">Vat(%):<span>
                                                <input class="form-control small-input" type="text" value="10" />$120</span></p>
                                        <h5 class="font-weight-bold d-flex align-items-center">Grand Total:<span>
                                                <input class="form-control small-input" type="text" value="$" />$1320</span></h5>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <!-- ==== / Edit Area =====-->
                    </div>
                </div>
            </div>
        </div>
    </div><!-- end of main-content -->
</div>
@elseif($commande->id_fournisseur == 3)
<div class="main-content pt-4">
    <div class="row">
        <div class="col-md-12">
            <ul class="nav nav-tabs justify-content-end mb-4" id="myTab" role="tablist">
                <li class="nav-item"><a class="nav-link active" id="invoice-tab" data-toggle="tab" href="#invoice" role="tab" aria-controls="invoice" aria-selected="true">Bon de livraison</a></li>
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
                                            <strong style="color: #0f70b7; font-size:32px; font-weight:800; font-family: Arial black !important;">BON DE LIVRAISON</strong>    
                                        </div>
                                        <div class="col-md-5 mt-2" style="text-align: center">
                                            <strong style="color: #d40707; font-size:22px; font-weight:800; font-family: Arial black !important;">N?? {{ $commande->livraisons->first()->num_bl }}</strong>    
                                        </div>
                                        <div class="col-md-12 mt-5" style="color: #332a6c; font-family: Cambria !important;font-size:20px;">
                                            <div class="row">
                                                <div class="col-md-6 ">
                                                    <p style="font-weight:300;">N?? Client : {{ $commande->entreprise->id }}</p>
                                                    <p style="font-weight:300;">N?? Compte Contribuable : {{ $commande->entreprise->ncc }}</p>
                                                    <p style="font-weight:300;">Code commercial :.......................</p>
                                                </div>
                                                <div class="col-md-5" style="border: 3px solid #332a6c;border-radius:30px;">
                                                    <p style="font-weight:300;">Client : {{ $commande->entreprise->nom }}</p>
                                                    <p style="font-weight:300;">Adresse : {{ $commande->entreprise->adresse }}</p>
                                                    <p style="font-weight:300;">Contact : +225 {{ $commande->entreprise->contact }}</p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12 ">
                                                    <p style="font-weight:600;">Date : {{ ucwords((new Carbon\Carbon($commande->livraisons->first()->created_at))->locale('fr')->isoFormat('DD/MM/YYYY')) }}</p>   
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
                                                <th  scope="col">R??f.</th>
                                                <th  scope="col" >D??signation</th>
                                                <th  scope="col">Qt??</th>
                                                <th  scope="col">Num??ro S??rie</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($commande->products as $data)
                                            @if ($data->pivot->status == 1)
                                                <tr>
                                                    <th scope="row">{{ $data->ref }}</th>
                                                    <td>{{ $data->lib }}</td>
                                                    <td>{{ $data->pivot->qte }}</td>
                                                    <td></td>
                            
                                                </tr>
                                            @endif
                                            
                                            @empty
                                                
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="row" style="font-size:16px; ">
                                <div class="col-md-12 table-responsive">
                                    <table class="table table-hover mb-4">
                                        <thead class="" style="background-color : #0f70b7; color:white">
                                            <tr>
                                                <th scope="col">Client</th>
                                                <th scope="col">Livreur</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td scope="row">
                                                    @if ($commande->status == 3)
                                                    <p>Date de r??ception : {{ ucwords((new Carbon\Carbon($commande->livraisons->first()->date_reception_client))->locale('fr')->isoFormat('DD/MM/YYYY')) }}</p>
                                                    @endif
                                                    <p>Nom et pr??nom(s) : {{ $commande->entreprise->nom }}</p>
                                                    <p class="mt-5 mb-5"><strong>Visa</strong> </p>
                                                </td>
                                                <td>
                                                    <p>Date de r??ception : {{ ucwords((new Carbon\Carbon($commande->livraisons->first()->created_at))->locale('fr')->isoFormat('DD/MM/YYYY')) }}</p>
                                                    <p>Nom et pr??nom(s) : {{ $commande->livraisons->first()->livreur->nom }}</p>
                                                    <p class="mt-5 mb-5"><strong>Visa</strong> </p>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!-- ==== / Print Area =====-->
                    </div>
                    <div class="tab-pane fade" id="edit" role="tabpanel" aria-labelledby="edit-tab">
                        <!-- ==== Edit Area =====-->
                        <div class="d-flex mb-5"><span class="m-auto"></span>
                            <button class="btn btn-primary">Save</button>
                        </div>
                        <form>
                            <div class="row justify-content-between">
                                <div class="col-md-6">
                                    <h4 class="font-weight-bold">Order Info</h4>
                                    <div class="col-sm-4 form-group mb-3 pl-0">
                                        <label for="orderNo">Order Number</label>
                                        <input class="form-control" id="orderNo" type="text" placeholder="Enter order number" />
                                    </div>
                                </div>
                                <div class="col-md-3 text-right">
                                    <label class="d-block text-12 text-muted">Order Status</label>
                                    <div class="pr-0 mb-4">
                                        <label class="radio radio-reverse radio-danger">
                                            <input type="radio" name="orderStatus" value="Pending" /><span>Pending</span><span class="checkmark"></span>
                                        </label>
                                        <label class="radio radio-reverse radio-warning">
                                            <input type="radio" name="orderStatus" value="Processing" /><span>Processing</span><span class="checkmark"></span>
                                        </label>
                                        <label class="radio radio-reverse radio-success">
                                            <input type="radio" name="orderStatus" value="Delivered" /><span>Delivered</span><span class="checkmark"></span>
                                        </label>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="order-datepicker">Order Date</label>
                                        <input class="form-control text-right" id="order-datepicker" placeholder="yyyy-mm-dd" name="dp" />
                                    </div>
                                </div>
                            </div>
                            <div class="mt-3 mb-4 border-top"></div>
                            <div class="row mb-5">
                                <div class="col-md-6">
                                    <h5 class="font-weight-bold">Bill From</h5>
                                    <div class="col-md-10 form-group mb-3 pl-0">
                                        <input class="form-control" id="billFrom3" type="text" placeholder="Bill From" />
                                    </div>
                                    <div class="col-md-10 form-group mb-3 pl-0">
                                        <textarea class="form-control" placeholder="Bill From Address"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-6 text-right">
                                    <h5 class="font-weight-bold">Bill To</h5>
                                    <div class="col-md-10 offset-md-2 form-group mb-3 pr-0">
                                        <input class="form-control text-right" id="billFrom2" type="text" placeholder="Bill From" />
                                    </div>
                                    <div class="col-md-10 offset-md-2 form-group mb-3 pr-0">
                                        <textarea class="form-control text-right" placeholder="Bill From Address"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 table-responsive">
                                    <table class="table table-hover mb-3">
                                        <thead class="bg-gray-300">
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Item Name</th>
                                                <th scope="col">Unit Price</th>
                                                <th scope="col">Unit</th>
                                                <th scope="col">Cost</th>
                                                <th scope="col"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <th scope="row">1</th>
                                                <td>
                                                    <input class="form-control" value="Product 1" type="text" placeholder="Item Name" />
                                                </td>
                                                <td>
                                                    <input class="form-control" value="300" type="number" placeholder="Unit Price" />
                                                </td>
                                                <td>
                                                    <input class="form-control" value="2" type="number" placeholder="Unit" />
                                                </td>
                                                <td>600</td>
                                                <td>
                                                    <button class="btn btn-outline-secondary float-right">Delete</button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row">2</th>
                                                <td>
                                                    <input class="form-control" value="Product 1" type="text" placeholder="Item Name" />
                                                </td>
                                                <td>
                                                    <input class="form-control" value="300" type="number" placeholder="Unit Price" />
                                                </td>
                                                <td>
                                                    <input class="form-control" value="2" type="number" placeholder="Unit" />
                                                </td>
                                                <td>600</td>
                                                <td>
                                                    <button class="btn btn-outline-secondary float-right">Delete</button>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <button class="btn btn-primary float-right mb-4">Add Item</button>
                                </div>
                                <div class="col-md-12">
                                    <div class="invoice-summary invoice-summary-input float-right">
                                        <p>Sub total: <span>$1200</span></p>
                                        <p class="d-flex align-items-center">Vat(%):<span>
                                                <input class="form-control small-input" type="text" value="10" />$120</span></p>
                                        <h5 class="font-weight-bold d-flex align-items-center">Grand Total:<span>
                                                <input class="form-control small-input" type="text" value="$" />$1320</span></h5>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <!-- ==== / Edit Area =====-->
                    </div>
                </div>
            </div>
        </div>
    </div><!-- end of main-content -->
</div>
@endif

@endsection

@section('javascripts')
<script src="https://cdn.jsdelivr.net/npm/places.js@1.19.0"></script>
<script src="https://cdn.jsdelivr.net/npm/places.js@1.19.0/dist/cdn/placesAutocompleteDataset.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/places.js@1.19.0/dist/cdn/placesInstantsearchWidget.min.js"></script>

<script>
    $('#id_fournisseur').on('change', function() {
            //console.log(e);

        let id = $(this).val();
                //alert(id);
        $('.produit').empty();
        $('.produit').append(`<option value="0">chargement...</option>`);
        $.ajax({
                type: 'GET',
                url: '/bon-commande-products-fournisseur/' + id,
                success: function(response) {
                    var response = JSON.parse(response);
                        //console.log(response);
                    $('.produit').empty();
                    $('.produit').append(
                            `<option value=""  selected>-- S??lectionner --</option>`);
                    response.forEach(element => {
                        $('.produit').append(
                            `<option value="${element['id']}">${element['lib']}</option>`
                            );
                    });
                }
            });
            
    });
</script>
<script>
   $('.btnblprint').on('click', function() {
    window.print();
   });
</script>

<script>

</script>
@endsection