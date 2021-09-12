@extends('main.stock.partials.main')
@section('stylesheets')

@endsection

@section('menuTitle')
Client
@endsection

@section('pageTitle')
Modifier un client
@endsection

@section('content')
<div class="row">
    <div class="col-md-6 col-offset-3">
        <div class="card mb-4">
            <div class="card-body">
                <div class="card-title mb-3">Formulaire de modification de </div>
                <form method="put" action="{{ route('stock.client.update', ['slug'=>$client->slug])}}">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-6 form-group mb-3">
                            <label for="firstName1">Nom</label>
                            <input class="form-control" id="nom" name="nom" value="{{ $client->nom }}" type="text" placeholder="Entrez le nom" required />
                            @if ($errors->has('nom'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('nom') }}
                                </div>
                            @endif
                        </div>
                        <div class="col-md-6 form-group mb-3">
                            <label for="lastName1">Catégorie</label>
                            <select name="category" id="personne" class="form-control" required>
                                <option value="0" disabled>Choisir une catégorie</option>
                                <option value="Personne morale" @if ( $client->category =='Personne morale') selected="selected" @endif>Personne morale</option>
                                <option value="Personne physique" @if ( $client->category =='Personne physique') selected="selected" @endif>Personne physique</option>
                            </select>                            
                            @if ($errors->has('category'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('category') }}
                                </div>
                            @endif
                        </div>
                        <div class="col-md-6 form-group mb-3">
                            <label for="picker1">Statut</label>
                            <select name="statut" id="statut" class="form-control" required>
                                <option value="0" disabled>Choisir un statut</option>
                                <option value="SA" @if ( $client->statut =='SA') selected="selected" @endif>SA</option>
                                <option value="SARL" @if ( $client->statut =='SARL') selected="selected" @endif>SARL</option>
                                <option value="Masculin" @if ($client->statut =='Masculin') selected="selected" @endif>Masculin</option>
                                <option value="Féminin" @if ( $client->statut =='Féminin') selected="selected" @endif>Féminin</option>
                            </select>
                            @if ($errors->has('statut'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('statut') }}
                                </div>
                            @endif
                        </div>
                        <div class="col-md-6 form-group mb-3">
                            <label for="exampleInputEmail1">Email</label>
                            <input class="form-control" id="exampleInputEmail1" name="email" value="{{ $client->email }}" type="email" placeholder="Entrez l'email" required/>
                            @if ($errors->has('email'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('email') }}
                                </div>
                            @endif
                            <!--  <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
                        </div>
                        <div class="col-md-6 form-group mb-3">
                            <label for="phone">Téléphone</label>
                            <input class="form-control" id="phone" name="contact" value="{{ $client->contact }}" placeholder="Entrez le téléphone" required data-inputmask='"mask": "+(255) 99-99-99-99-99"' data-mask/>
                            @if ($errors->has('contact'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('contact') }}
                                </div>
                            @endif
                        </div>
                        <div class="col-md-6 form-group mb-3">
                            <label for="picker2">Adresse</label>
                            <input class="form-control" id="picker2" name="adresse" value="{{ $client->adresse }}" placeholder="Lieu d'habitation" required/>
                            @if ($errors->has('adresse'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('adresse') }}
                                </div>
                            @endif
                        </div>
                        <div class="col-md-12">
                            <button class="btn btn-primary">Valider</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('javascripts')
<script>
    let valeur = $('#personne').val();
            console.log(valeur)
            if (valeur == "Personne morale") {
                //alert(id);
                $('#statut').empty();
                $('#statut').append(`<option value="0">chargement...</option>`);
                $('#statut').empty();
                $('#statut').append(`<option value="0" disabled>Choisir un statut</option><option value="SA" @if ( $client->statut =='SA') selected="selected" @endif>SA</option>
                                <option value="SARL" @if ( $client->statut =='SARL') selected="selected" @endif>SARL</option>`);
            }else if(valeur == "Personne physique"){
                $('#statut').empty();
                $('#statut').append(`<option value="0">chargement...</option>`);
                $('#statut').empty();
                $('#statut').append(`<option value="0" disabled>Choisir un statut</option><option value="Masculin" @if ($client->statut =='Masculin') selected="selected" @endif>Masculin</option>
                                <option value="Féminin" @if ( $client->statut =='Féminin') selected="selected" @endif>Féminin</option>`);
            }

    $('#personne').on('change', function() {
            //console.log(e);

            let valeur = $(this).val();
            console.log(valeur)
            if (valeur == "Personne morale") {
                //alert(id);
                $('#statut').empty();
                $('#statut').append(`<option value="0">chargement...</option>`);
                $('#statut').empty();
                $('#statut').append(`<option value="0" disabled selected>Choisir un statut</option><option value="SA" @if (old('statut')=='SA') selected="selected" @endif>SA</option>
                                <option value="SARL" @if (old('statut')=='SARL') selected="selected" @endif>SARL</option>`);
            }else if(valeur == "Personne physique"){
                $('#statut').empty();
                $('#statut').append(`<option value="0">chargement...</option>`);
                $('#statut').empty();
                $('#statut').append(`<option value="0" disabled selected>Choisir un statut</option><option value="Masculin" @if (old('statut')=='Masculin') selected="selected" @endif>Masculin</option>
                                <option value="Féminin" @if (old('Féminin')=='Féminin') selected="selected" @endif>Féminin</option>`);
            }

        });
</script>
@endsection