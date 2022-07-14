@extends('admin.partials.main')

@section('stylesheets')
    <link rel="stylesheet" href="{{ asset('myplugins/dropify/css/dropify.css') }}" />
    
    <link rel="stylesheet" type="text/css" href="{{ asset('myplugins/Dual-Listbox-Transfer/icon_font/css/icon_font.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('myplugins/Dual-Listbox-Transfer/css/jquery.transfer.css?v=0.0.3') }}" />

@endsection

@section('menuTitle')
Utilisateurs
@endsection

@section('pageTitle')
Ajouter un utilisateur
@endsection

@section('content')
<div class="row">
    <div class="container-fluid">
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
                        <div class="form-group col-lg-4 col-md-6">
                            <label class="ul-form__label" for="employes_id">Employé:</label>
                            <select name="employes_id" id="employes_id" class="form-control" required>
                                <option value="" selected>-- Sélectionner --</option>
                                <option value="none">Aucun</option>
                                @forelse ($employes->sortBy('nom') as $employe)
                                    <option value="{{ $employe->id }}" @if (old('employes_id')== '{{ $employe->id }}') selected="selected" @endif>
                                        {{ $employe->civilite }} {{ $employe->nom }} {{ $employe->prenoms }}
                                    </option>
                                @empty
                                    
                                @endforelse
                            </select>
                            @if ($errors->has('employes_id'))
                                <div class="alert-danger p-1 ">
                                    {{ $errors->first('employes_id') }}
                                </div>
                            @endif
                            <small class="ul-form__text form-text" id="">
                                Entrez le nom d'utilisateur svp!
                            </small>
                        </div>
                        
                        <div class="form-group col-lg-4 col-md-6">
                            <label class="ul-form__label" for="email">Email:</label>
                            <input class="form-control" value="{{ old('email') }}" name="email" id="email" type="text" placeholder="Ex: Papier rame" required/>
                            @if ($errors->has('email'))
                                <div class="alert-danger p-1">
                                    {{ $errors->first('email') }}
                                </div>
                            @endif
                            <small class="ul-form__text form-text" id="">
                                Entrez l'adresse email de l'utilisateur svp!
                            </small>
                        </div>

                        <div class="form-group col-lg-4 col-md-6">
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

                        <div class="form-group col-lg-5 col-md-6">
                            <label class="ul-form__label">Entreprise de production</label>
                            <div class="">
                                @foreach ($entreprises->sortBy('name') as $entreprise)
                                    <label class="radio radio-outline-primary ml-3" style="display: inline">
                                        <input type="radio" name="id_entreprises" value="{{ $entreprise->id }}" @if (old('id_entreprises') == $entreprise->id) selected="checked" @endif>
                                        <span class="d-none d-md-inline"><img src="{{ asset($entreprise->logo) }}" alt="" style="height: 4rem;"></span>
                                        <span class="d-inline d-md-none"><img src="{{ asset($entreprise->logo) }}" alt="" style="height: 2.5rem;"></span>
                                        <span class="checkmark"></span>
                                    </label>
                                @endforeach
                            </div>
                            @if ($errors->has('id_entreprises'))
                                <div class="alert-danger p-2 rounded">
                                    {{ $errors->first('id_entreprises') }}
                                </div>
                            @endif
                        </div>

                    </div>

                    <div class="custom-separator"></div>
                    
                    <div class="form-row">
                        <div class="form-group col-lg-2 col-md-4">
                            <label class="col-form-label" for="image">Image (.png | .jpg | .jpeg): </label>               
                            <input type="file" name="image" class="dropify-fr" data-bs-height="180" accept=".png, .jpg, .jpeg" />
                        </div>
                        <div class="form-group col-lg-4 col-md-6">
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
                        <div class="col">
                            <div id="transfer" class="transfer-demo"></div>
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
    <script src="{{ asset('myplugins/dropify/js/dropify.js') }}"></script>
    <script type="text/javascript" src="{{ asset('myplugins/Dual-Listbox-Transfer/js/jquery.transfer.js?v=0.0.6') }}"></script>
    <script>
        $(function(){
            // Basic
            $('.dropify').dropify();
    
            // Translated
            $('.dropify-fr').dropify({
                messages: {
                    default: 'Glissez-déposez un fichier ici ou cliquez',
                    replace: 'Glissez-déposez un fichier ou cliquez pour remplacer',
                    remove:  'Supprimer <i class="i-Remove"></i>',
                    error:   'Désolé, le fichier trop volumineux'
                }
            });

            var groupDataArray1 = [
                {
                    "groupName": "China",
                    "groupData": [
                        {
                            "city": "Beijing",
                            "value": 122
                        },
                        {
                            "city": "Shanghai",
                            "value": 643
                        },
                        {
                            "city": "Qingdao",
                            "value": 422
                        },
                        {
                            "city": "Tianjin",
                            "value": 622
                        }
                    ]
                },
                {
                    "groupName": "Japan",
                    "groupData": [
                        {
                            "city": "Tokyo",
                            "value": 132
                        },
                        {
                            "city": "Osaka",
                            "value": 112
                        },
                        {
                            "city": "Yokohama",
                            "value": 191
                        }
                    ]
                }
            ];

            var settings3 = {
                "groupDataArray": groupDataArray1,
                "groupItemName": "groupName",
                "groupArrayName": "groupData",
                "itemName": "city",
                "valueName": "value",
                "tabNameText": "Disponibles",
                "rightTabNameText": "Selectionnées ",
                "searchPlaceholderText": "rechercher",
                "callable": function (items) {
                    console.dir(items)
                }
            };

            $("#transfer").transfer(settings3);
        })
    </script>
@endsection