@extends('main.stock.partials.main')

@section('stylesheets')
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
@endsection

@section('menuTitle')
Bon de commande
@endsection

@section('pageTitle')
Affichage du bon de commande
@endsection

@section('content')

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
                                            <strong style="color: #0f70b7; font-size:32px; font-weight:800; font-family: Arial black !important;">N° .........</strong>    
                                        </div>
                                        <div class="col-md-12 mt-5" style="color: #47404F; font-family: Cambria !important;font-size:20px;">
                                            <div class="row">
                                                <div class="col-md-5 ">
                                                    
                                                    <p style="font-weight:600;">Date : .....................</p>
                                                </div>
                                                <div class="col-md-6" style="border: 3px solid #47404F;border-radius:30px;">
                                                    <p style="font-weight:300;">Fournisseur : .................</p>
                                                    <p style="font-weight:300;">Adresse : ......................</p>
                                                    <p style="font-weight:300;">Contact :..............................</p>
                                                    <p style="font-weight:300;">N° CC :..............................</p>
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
                                                <tr>
                                                    <th scope="row">P4</th>
                                                    <td>Poulet bio Thalila</td>
                                                    <td>47</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">P8</th>
                                                    <td>Poulet de chair</td>
                                                    <td>21</td>
                                                </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="row mb-5" style="font-size:16px; ">
                                <div class="col-md-6 text-center">
                                    <u>Signature du Directeur Général</u>   
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
                            `<option value=""  selected>-- Sélectionner --</option>`);
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