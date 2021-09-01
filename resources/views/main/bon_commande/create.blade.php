@extends('main.layout.main')

@section('stylesheets')

@endsection

@section('menuTitle')
Commande
@endsection

@section('pageTitle')
Créer un bon de commande
@endsection

@section('content')
<div class="row">
    <div class="col-md-9">
        <div class="card animate__animated animate__backInDown">
            <div class="card-header bg-transparent">
            <h3 class="card-title">Création du bon de commande</h3>
            </div>
            <!-- begin::form-->
            <form method="post" action="{{ route('boncommande.store')}}" enctype="multipart/form-data">
                @csrf
                @method('POST')
                <div class="card-body">    
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label class="ul-form__label" for="id_fournisseur">Fournisseur:</label>
                            <select name="id_fournisseur" id="id_fournisseur" class="form-control" required>
                                <option value=""  selected>-- Sélectionner --</option>
                                @forelse (Fournisseur::where('status', 1)->orderBy('nom', 'asc')->get() as $data)
                                    <option value="{{ $data->id }}" @if (old('id_fournisseur')== '{{ $data->id }}') selected="selected" @endif>{{ $data->nom }}</option>
                                @empty
                                    
                                @endforelse
                            </select>
                                @if ($errors->has('id_fournisseur'))
                                    <div class="text-danger">
                                        <small class="ul-form__text form-text text-danger" id="passwordHelpBlock">{{ $errors->first('id_fournisseur') }}</small>
                                    </div>
                                    @else    
                                    <small class="ul-form__text form-text" id="">
                                        Choisissez le fournisseur svp!
                                    </small>
                                @endif
                        </div>
                        <div class="form-group col-md-4">
                            <label class="ul-form__label" for="date_livraison">Date de livraison</label>
                            <input class="form-control datepicker" value="{{ old('date_livraison') }}" name="date_livraison" id="date_livraison" placeholder="Ex: La date de livraison" type="text" />
                            @if ($errors->has('date_livraison'))
                            <div class="text-danger">
                                <small class="ul-form__text form-text text-danger" id="passwordHelpBlock">{{ $errors->first('date_livraison') }}</small>
                            </div>
                            @else    
                            <small class="ul-form__text form-text" id="">
                                Entrez la date de livraison svp!
                            </small>
                            @endif
                        </div>
                        <div class="form-group col-md-4">
                            <label class="ul-form__label" for="lieu_livraison">Lieu de livraison:</label>
                            <input class="form-control" value="{{ old('lieu_livraison') }}" name="lieu_livraison" id="lieu" type="text" placeholder="Ex: Abidjan" />
                            @if ($errors->has('lieu_livraison'))
                            <div class="text-danger">
                                <small class="ul-form__text form-text text-danger" id="passwordHelpBlock">{{ $errors->first('lieu_livraison') }}</small>
                            </div>
                            @else    
                            <small class="ul-form__text form-text" id="">
                                Entrez le lieu de livraison svp!
                            </small>
                            @endif
                        </div>
                        <div class="form-group col-md-4">
                            <label class="col-form-label" for="qte">Pro-forma</label>
                                            
                            <div class="custom-file">
                                <input class="custom-file-input" id="inputGroupFile01" type="file" name="proforma" aria-describedby="inputGroupFileAddon01" />
                                <label class="custom-file-label" for="inputGroupFile01">Choisir un fichier</label>
                            </div>
                        </div>
                    </div>
                    <div class="custom-separator"></div>
                    <div class="form-row" id="lotprod">
                        <div class="form-group col-md-6">
                            <label class="ul-form__label" for="product[]">Produit:</label>
                            <select name="product[]"  class="form-control produit" id="product-0">
                                <option value=""  selected>-- Sélectionner --</option>
                                @forelse (Product::where('status', 1)->orderBy('lib', 'asc')->get() as $data)
                                    <option value="{{ $data->id }}" @if (old('product[]')== '{{ $data->id }}') selected="selected" @endif>{{ $data->lib }}</option>
                                @empty
                                    
                                @endforelse
                            </select><small class="ul-form__text form-text" id="">
                                Choisissez le produit svp!
                            </small>
                            @if ($errors->has('product[]'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('product[]') }}
                                </div>
                            @endif
                        </div>
                        <div class="form-group col-md-2">
                            <label class="ul-form__label" for="prix[]">Prix:</label>
                            <input class="form-control" value="{{ old('prix[]') }}" name="prix[]" id="prix-0" type="number" placeholder="Ex: 2500"/><small class="ul-form__text form-text" id="">
                                Entrez le prix du produit !
                            </small>
                            @if ($errors->has('prix[]'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('prix[]') }}
                                </div>
                            @endif
                        </div>
                        <div class="form-group col-md-2">
                            <label class="ul-form__label" for="qte[]">Quantité:</label>
                            <input class="form-control" value="{{ old('qte[]') }}" name="qte[]" id="qte-0" type="number" placeholder="Ex: 150"/><small class="ul-form__text form-text" id="">
                                Entrez la quantité commandée !
                            </small>
                            @if ($errors->has('qte[]'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('qte[]') }}
                                </div>
                            @endif
                        </div>
                        {{-- <div class="form-group col-md-2">
                            <label class="ul-form__label" for="volume">supprimer</label>
                            <button id="sup-"class="btn btn-outline-danger btn-icon m-1 mt-0" type="button"><span class="ul-btn__icon"><i class="i-Remove"></i></span></button>
                        </div> --}}
                    </div>
                    <div class="form-row">
                        <button id="addProduct" class="btn btn-md btn-warning mt-3 ladda-button basic-ladda-button" style="float: right" data-style="expand-right"><span class="ladda-label">Ajouter un produit</span></button>
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
            <!--  end::form 3-->
        </div>
    </div>
</div>
@endsection

@section('javascripts')
<script src="https://cdn.jsdelivr.net/npm/places.js@1.19.0"></script>
<script src="https://cdn.jsdelivr.net/npm/places.js@1.19.0/dist/cdn/placesAutocompleteDataset.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/places.js@1.19.0/dist/cdn/placesInstantsearchWidget.min.js"></script>
<script>    
    var placesAutocomplete = places({
    appId: 'plYHYZFG2EIV',
    apiKey: '58ba156fd3af6b2f31fc7eb07360245a',
    container: document.querySelector('#lieu')
    });

    $('#date_livraison').on('focus', function() {
        $('.datepicker').pickadate({
            monthsFull: ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'],
            weekdaysShort: ['Dim', 'Lun', 'Mar', 'Mer', 'Jeu', 'Ven', 'Sam'],
            today: 'aujourd\'hui',
            clear: 'effacer',
            format: 'dd-mm-yyyy',
            formatSubmit: 'dd-mm-yyyy',
            close: 'fermer',
            selectYears: true,
            selectMonths: true,
            labelMonthNext: 'Mois suivant',
            labelMonthPrev: 'Mois précédent',
            labelMonthSelect: 'Selectionner un mois',
            labelYearSelect: 'Selectionner une année',
            min: Date.now(),
            disable: [
                1, 7
            ]
        });
    });
</script>
<script type="text/javascript">
    $(function () {
        $('#datetimepicker4').datetimepicker();
    });
 </script>
 <script>
   
     var $i=0;
    
     $('#addProduct').on('click', function(e){
        $i++;
        e.preventDefault();
        console.log('bonjour');
        $('#lotprod').append(`
                        <div class="form-group col-md-6" id="prod-${$i}">
                            <label class="ul-form__label" for="product[]">Produit:</label>
                            <select name="product[]" class="form-control produit" id="product-${$i}">
                                <option value=""  selected>-- Sélectionner --</option>
                                @forelse (Product::where("status", 1)->orderBy('lib', 'asc')->get() as $data)
                                    <option value="{{ $data->id }}" @if (old('product[]')== '{{ $data->id }}') selected="selected" @endif>{{ $data->lib }}</option>
                                @empty
                                    
                                @endforelse
                            </select><small class="ul-form__text form-text" id="">
                                Choisissez l'unité svp!
                            </small>
                            @if ($errors->has('product[]'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('product[]') }}
                                </div>
                            @endif
                        </div>
                        <div class="form-group col-md-2" id="prix-${$i}">
                            <label class="ul-form__label" for="prix[]">Prix:</label>
                            <input class="form-control" value="{{ old('prix[]') }}" name="prix[]" id="prix-${$i}" type="number" placeholder="Ex: 150"/><small class="ul-form__text form-text" id="">
                                Entrez le prix du produit svp!
                            </small>
                            @if ($errors->has('qte[]'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('qte[]') }}
                                </div>
                            @endif
                        </div>
                        <div class="form-group col-md-2" id="quantite-${$i}">
                            <label class="ul-form__label" for="qte[]">Quantité:</label>
                            <input class="form-control" value="{{ old('qte[]') }}" name="qte[]" id="qte-${$i}" type="number" placeholder="Ex: 150"/><small class="ul-form__text form-text" id="">
                                Entrez la quantité svp!
                            </small>
                            @if ($errors->has('qte[]'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('qte[]') }}
                                </div>
                            @endif
                        </div>
                        <div class="form-group col-md-2" id="supbtn-${$i}">
                            <label class="ul-form__label" for="volume">supprimer</label>
                            <button onclick="supprimer(event)" id="sup-${$i}" class="btn btn-outline-danger btn-icon m-1 mt-0" type="button"><span onclick="supprimer(event)" id="supspan-${$i}" class="ul-btn__icon"><i onclick="supprimer(event)" id="supi-${$i}" class="i-Remove"></i></span></button>
                        </div>
        `);    
        
        let id = $("#id_fournisseur").val();
       
        $("#product-"+$i).empty();

        $("#product-"+$i).append(`<option value="0">chargement...</option>`);

        $.ajax({
                type: 'GET',
                url: '/bon-commande-products-fournisseur/' + id,
                success: function(response) {
                    var response = JSON.parse(response);
                        //console.log(response);
                    $("#product-"+$i).empty();
                    $("#product-"+$i).append(
                            `<option value=""  selected>-- Sélectionner --</option>`);
                    response.forEach(element => {
                        $("#product-"+$i).append(
                            `<option value="${element['id']}">${element['lib']}</option>`
                            );
                    });
                }
            });
    

        
     });


 </script>
 <script>
    function supprimer(e){
   e.preventDefault();
   //alert('bonjour');
   //console.log(e.target.id);
   var res = e.target.id.split('-');
   var id = res[1];
   $('#prod-'+id).remove();
   $('#quantite-'+id).remove();
   $('#prix-'+id).remove();
   $('#supbtn-'+id).remove();
}
</script>
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
@endsection