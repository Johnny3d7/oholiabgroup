@extends('main.stock.partials.main')

@section('stylesheets')

@endsection

@section('menuTitle')
Fournisseur
@endsection

@section('pageTitle')
Liste des fournisseurs
@endsection

@section('content')
<div class="row mb-4">
    <div class="col-md-12 mb-4">
        <div class="card text-left">
            
            <div class="card-body">
                
                {{--  <a href="{{ route('stock.products.create') }}">--}}<button class="btn btn-lg btn-primary" data-toggle="modal" data-target="#addfournisseur" data-whatever="@fat" style="float: right" data-style="expand-right"><span class="ladda-label">Ajouter un fournisseur</span></button>{{--</a>--}}
                <div class="modal fade" id="addfournisseur" tabindex="-1" role="dialog" aria-labelledby="addfournisseur" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="addfournisseur_title">Ajout d'un nouveau fournisseur</h5>
                                <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                            </div>
                            <div class="modal-body">
                                <form method="post" action="{{ route('stock.fournisseur.store')}}">
                                    @csrf
                                    @method('POST')
                                    <div class="form-group ">
                                        <label class="col-form-label" for="nom">Nom du fournisseur:</label>
                                        <input class="form-control" id="nom" type="text" name="nom" required/>
                                    </div>
                                    <div class="form-group ">
                                        <label class="col-form-label" for="slug_type_fournisseur">Catégorie fournisseur:</label>
                                        <select name="slug_type_fournisseur" class="form-control" required>
                                            @forelse (TypeFournisseur::where('status', 1)->orderBy('lib', 'asc')->get() as $data)
                                                <option value="{{ $data->slug }}" @if (old('slug_type_fournisseur')== '{{ $data->slug }}') selected="selected" @endif>{{ $data->lib }}</option>
                                            @empty
                                                
                                            @endforelse
                                        </select>
                                    </div>
                                    <div class="form-group ">
                                        <label class="col-form-label" for="contact">Contact:</label>
                                        <input class="form-control" id="contact" type="text" name="contact" data-inputmask='"mask": "+(255) 99-99-99-99-99"' data-mask required/>
                                    </div>
                                    <div class="form-group ">
                                        <label class="col-form-label" for="email">Email:</label>
                                        <input class="form-control" id="email" type="email" name="email" required/>
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
                                <th>Code</th>
                                <th>Nom</th>
                                <th>Catégorie</th>
                                <th>Contact</th>
                                <th>email</th>
                                <th>Date d'ajout</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($fournisseurs as $data)
                                <tr>
                                    <td>{{ $data->codefour }}</td>
                                    <td>{{ $data->nom }}</td>
                                    <td>{{ $data->typeFournisseur->lib }}</td>
                                    <td>{{ $data->contact }}</td>
                                    <td>{{ $data->email }}</td>
                                    <td>{{ ucwords((new Carbon\Carbon($data->created_at))->locale('fr')->isoFormat('DD/MM/YYYY')) }}</td>
                                    <td><button class="btn btn-outline-success m-1" type="button" data-toggle="modal" data-target="#verifyModalContent{{ $data->id }}" data-whatever="@fat">Modifier</button><a href="{{ route('stock.fournisseur.destroy',['slug'=>$data->slug]) }}"><button class="btn btn-outline-danger m-1" type="button">Supprimer</button></a></td>
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
                                                        <label class="col-form-label" for="nom">Nom du fournisseur:</label>
                                                        <input class="form-control" id="nom" value="{{ $data->nom }}" type="text" name="nom" required/>
                                                    </div>
                                                    <div class="form-group ">
                                                        <label class="col-form-label" for="slug_type_fournisseur">Catégorie fournisseur:</label>
                                                        <select name="slug_type_fournisseur" class="form-control" required>
                                                            @forelse (TypeFournisseur::where('status', 1)->orderBy('lib', 'asc')->get()  as $type)
                                                            @if ($data->typeFournisseur->slug == $type->slug)
                                                            <option value="{{ $type->slug }}" selected>{{ $type->lib }}</option>
                                                            @else
                                                            <option value="{{ $type->slug }}">{{ $type->lib }}</option>
                                                            @endif
                                                            @empty
                                                                
                                                            @endforelse
                                                        </select>
                                                    </div>
                                                    <div class="form-group ">
                                                        <label class="col-form-label" for="contact">Contact:</label>
                                                        <input class="form-control" id="contact" value="{{ $data->contact }}" type="text" name="contact" data-inputmask='"mask": "+(255) 99-99-99-99-99"' data-mask required/>
                                                    </div>
                                                    <div class="form-group ">
                                                        <label class="col-form-label" for="email">Email:</label>
                                                        <input class="form-control" id="email" type="email" value="{{ $data->email }}" name="email" required/>
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
                                <th>Code</th>
                                <th>Nom</th>
                                <th>Catégorie</th>
                                <th>Contact</th>
                                <th>email</th>
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
