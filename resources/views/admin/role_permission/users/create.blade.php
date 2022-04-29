@extends('admin.partials.main')

@section('stylesheets')

@endsection

@section('menuTitle')
Utilisateurs
@endsection

@section('pageTitle')
Ajouter un utilisateur
@endsection

@section('content')
<div class="row">
    <div class="container">
        <section class="ul-product-detail__box">
            <div class="row">
                    <div class="col-lg-3 col-md-3 mt-1 mb-4 text-center">
                        <a href="{{ route('admin.users.index')}}">
                        <div class="card">
                            <div class="card-body">
                                <div class="ul-product-detail__border-box">
                                    <div class="ul-product-detail--icon mb-2"><i class="i-Check text-success text-25 font-weight-500"></i></div>
                                    <h5 class="heading">Liste des utilisateurs</h5>
                                    <p class="text-muted text-12">Afficher la liste de tous les utilisateurs.</p>
                                </div>
                            </div>
                        </div>
                    </a>
                    </div>
            </div>
        </section>
        <div class="card animate__animated animate__backInDown">
            <div class="card-header bg-transparent">
            <h3 class="card-title">Ajout d'un nouvel utilisateur</h3>
            </div>
            <!-- begin::form-->
            <form method="post" action="{{ route('admin.users.store')}}" enctype="multipart/form-data">
                @csrf
                @method('POST')
                <div class="card-body">    
                    <div class="form-row">
                        <div class="form-group col-md-5">
                            <label class="ul-form__label" for="username">Nom d'utilisateur:</label>
                            <input class="form-control" value="{{ old('username') }}" name="username" id="username" type="text" placeholder="Ex: Papier rame" required/>
                            @if ($errors->has('username'))
                                <div class="alert-danger p-1 ">
                                    {{ $errors->first('username') }}
                                </div>
                            @endif
                            <small class="ul-form__text form-text" id="">
                                Entrez le nom d'utilisateur svp!
                            </small>
                        </div>
                        <div class="form-group col-md-7">
                            <label class="ul-form__label" for="email">Email:</label>
                            <input class="form-control" value="{{ old('email') }}" name="email" id="email" type="text" placeholder="Ex: Papier rame" required/>
                            @if ($errors->has('email'))
                                <div class="alert-danger p-1 ">
                                    {{ $errors->first('email') }}
                                </div>
                            @endif
                            <small class="ul-form__text form-text" id="">
                                Entrez l'adresse email de l'utilisateur svp!
                            </small>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="ul-form__label" for="id_entreprises">Entreprise:</label>
                            <select name="id_entreprises" id="id_entreprises" class="form-control" required>
                                <option value=""  selected>-- Sélectionner --</option>
                                @forelse ($entreprises->sortBy('name') as $entreprise)
                                    <option value="{{ $entreprise->id }}" @if (old('id_entreprises')== '{{ $entreprise->id }}') selected="selected" @endif>{{ $entreprise->name }}</option>
                                @empty
                                    
                                @endforelse
                            </select>
                            @if ($errors->has('id_entreprises'))
                                <div class="alert-danger p-1 ">
                                    {{ $errors->first('id_entreprises') }}
                                </div>
                            @endif
                            <small class="ul-form__text form-text" id="">
                                Choisissez l'entreprise de l'utilisateur svp!
                            </small>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="ul-form__label" for="id_roles">Role:</label>
                            <select name="id_roles" id="id_roles" class="form-control" required>
                                <option value=""  selected>-- Sélectionner --</option>
                                @forelse ($roles->sortBy('name') as $role)
                                    <option value="{{ $role->id }}" @if (old('id_roles')== '{{ $role->id }}') selected="selected" @endif>{{ $role->name }}</option>
                                @empty
                                    
                                @endforelse
                            </select>
                            @if ($errors->has('id_roles'))
                                <div class="alert-danger p-1 ">
                                    {{ $errors->first('id_roles') }}
                                </div>
                            @endif
                            <small class="ul-form__text form-text" id="">
                                Choisissez le role de l'utilisateur svp!
                            </small>
                        </div>
                    </div>
                        
                    <div class="custom-separator"></div>
                    <div class="form-group col-md-4">
                        <label class="col-form-label" for="qte">Image (.png | .jpg | .jpeg): </label>               
                        <div class="custom-file">
                            <input class="custom-file-input" id="inputGroupFile01" type="file" name="image" aria-describedby="inputGroupFileAddon01" />
                            <label class="custom-file-label" for="inputGroupFile01">Choisir une image </label>
                        </div>
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
    container: document.querySelector('#addr')
    });
</script>
<script type="text/javascript">
    $(function () {
        $('#datetimepicker4').datetimepicker();
    });
 </script>
@endsection