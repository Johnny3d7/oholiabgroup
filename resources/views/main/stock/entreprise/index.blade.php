@extends('main.stock.partials.main')

@section('stylesheets')

@endsection

@section('menuTitle')
Entreprise
@endsection

@section('pageTitle')
Liste des entreprises
@endsection

@section('content')
<div class="row mb-4">
    <div class="col-md-12 mb-4">
        <div class="card text-left">
            
            <div class="card-body">
                
                {{--  <a href="{{ route('stock.products.create') }}">--}}<button class="btn btn-lg btn-primary" data-toggle="modal" data-target="#addentreprise" data-whatever="@fat" style="float: right" data-style="expand-right"><span class="ladda-label">Ajouter un fournisseur</span></button>{{--</a>--}}
                <div class="modal fade" id="addentreprise" tabindex="-1" role="dialog" aria-labelledby="addentreprise" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="addentreprise_title">Ajout d'une nouvelle entreprise</h5>
                                <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                            </div>
                            <div class="modal-body">
                                <form method="post" action="{{ route('stock.entreprise.store')}}">
                                    @csrf
                                    @method('POST')
                                    <div class="form-group ">
                                        <label class="col-form-label" for="nom">Nom de l'entreprise:</label>
                                        <input class="form-control" id="nom" type="text" name="nom" required/>
                                    </div>
                                    <div class="form-group ">
                                        <label class="col-form-label" for="email">Email:</label>
                                        <input class="form-control" id="email" type="email" name="email" required/>
                                    </div>
                                    <div class="form-group ">
                                        <label class="col-form-label" for="adresse">Adresse:</label>
                                        <input class="form-control" id="adresse" type="text" name="adresse" required/>
                                    </div>
                                    <div class="form-group ">
                                        <label class="col-form-label" for="contact">Contact:</label>
                                        <input class="form-control" id="contact" type="text" name="contact" data-inputmask='"mask": "+(255) 99-99-99-99-99"' data-mask required/>
                                    </div>
                                    <div class="modal-footer">
                                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Fermer</button>
                                        <button class="btn btn-primary" type="submit">Valider</button>
                                    </div>
                                </form>
                                
                            </div>
                            
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="display table table-striped table-bordered" id="zero_configuration_table" style="width:100%">
                        <thead>
                            <tr>
                                <th>Nom</th>
                                <th>Email</th>
                                <th>Adresse</th>
                                <th>Contact</th>
                                <th>Date d'ajout</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($entreprises as $data)
                                <tr>
                                    <td>{{ $data->nom }}</td>
                                    <td>{{ $data->email }}</td>
                                    <td>{{ $data->adresse }}</td>
                                    <td>{{ $data->contact }}</td>
                                    <td>{{ ucwords((new Carbon\Carbon($data->created_at))->locale('fr')->isoFormat('DD/MM/YYYY')) }}</td>
                                    <td><button class="btn btn-outline-success m-1" type="button" data-toggle="modal" data-target="#verifyModalContent{{ $data->id }}" data-whatever="@fat">Modifier</button><a href="{{ route('stock.entreprise.destroy',['slug'=>$data->slug]) }}"><button class="btn btn-outline-danger m-1" type="button">Supprimer</button></a></td>
                                </tr>
                                <div class="modal fade" id="verifyModalContent{{ $data->id }}" tabindex="-1" role="dialog" aria-labelledby="verifyModalContent{{ $data->id }}" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="verifyModalContent{{ $data->id }}_title">Modification du fournisseur {{ $data->nom }}</h5>
                                                <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                            </div>
                                            <div class="modal-body">
                                                <form method="put" action="{{ route('stock.fournisseur.update', ['slug'=>$data->slug])}}">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="form-group ">
                                                        <label class="col-form-label" for="nom">Nom de l'entreprise:</label>
                                                        <input class="form-control" id="nom" value="{{ $data->nom }}" type="text" name="nom" required/>
                                                    </div>
                                                    <div class="form-group ">
                                                        <label class="col-form-label" for="email">Email:</label>
                                                        <input class="form-control" id="email" {{ $data->email }} type="email" name="email" required/>
                                                    </div>
                                                    <div class="form-group ">
                                                        <label class="col-form-label" for="adresse">Adresse:</label>
                                                        <input class="form-control" id="adresse" {{ $data->adresse }} type="text" name="adresse" required/>
                                                    </div>
                                                    <div class="form-group ">
                                                        <label class="col-form-label" for="contact">Contact:</label>
                                                        <input class="form-control" id="contact" {{ $data->contact }} type="text" name="contact" data-inputmask='"mask": "+(255) 99-99-99-99-99"' data-mask required/>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Fermer</button>
                                                        <button class="btn btn-primary" type="submit">Valider</button>
                                                    </div>
                                                </form>
                                                
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>
                            @empty
                                
                            @endforelse
                            

                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Nom</th>
                                <th>Email</th>
                                <th>Adresse</th>
                                <th>Contact</th>
                                <th>Date d'ajout</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('javascripts')

@endsection