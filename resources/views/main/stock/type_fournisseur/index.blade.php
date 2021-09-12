@extends('main.stock.partials.main')

@section('stylesheets')

@endsection

@section('menuTitle')
Type fournisseur
@endsection

@section('pageTitle')
Liste  des catégories de fournisseurs
@endsection

@section('content')
<section class="widgets-content">
    <div>
        <!-- begin::first-section-->
        <div class="row">
            <div class="col-lg-7 col-xl-7 mb-4 mt-4">
                <!-- projects-->
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">Liste des catégories de fournisseurs</div>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">ID</th>
                                        <th scope="col">Libellé</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($types as $type)
                                        <tr>
                                            <th scope="row">{{ $type->id }}</th>
                                            <td><span class="text-15 font-weight-200">{{ $type->lib }}</span><br /></td>
                                            <td><button class="btn btn-outline-success m-1" type="button" data-toggle="modal" data-target="#verifyModalContent{{ $type->id }}" data-whatever="@fat">Modifier</button><a href="{{ route('stock.type_fournisseur.destroy',['slug'=> $type->slug]) }}"><button class="btn btn-outline-danger m-1" type="button">Supprimer</button></a></td>

                                        </tr>
                                        <div class="modal fade" id="verifyModalContent{{ $type->id }}" tabindex="-1" role="dialog" aria-labelledby="verifyModalContent{{ $type->id }}" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="verifyModalContent{{ $type->id }}_title">Modification du type {{ $type->lib }}</h5>
                                                        <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form method="put" action="{{ route('stock.type_fournisseur.update', ['slug'=>$type->slug])}}">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="form-group">
                                                                <label class="col-form-label" for="recipient-name-3{{ $type->id }}">Libellé:</label>
                                                                <input class="form-control" value="{{ $type->lib }}" id="recipient-name-3{{ $type->id }}" type="text" name="lib"/>
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
                            </table>
                        </div>
                    </div>
                </div>
                <!-- end:projects-->
            </div>
            <div class="col-lg-5 col-xl-5 mb-4 mt-0">
                <form method="POST" action="{{ route('stock.type_fournisseur.store')}}">
                    <!-- start card  Horizontal Form Layout-->
                    @csrf
                    @method('POST')
                    <div class="card ul-card__margin-25">
                        <div class="card-header bg-transparent">
                            <h3 class="card-title">Ajouter un nouveau type de fournisseur</h3>
                        </div>
                        <div class="card-body">
                            <div class="form-group row">
                                <label class="action-bar-horizontal-label col-lg-4 col-form-label" for="staticEmail">Libellé</label>
                                <div class="col-lg-6 mb-4">
                                    <input class="form-control" id="staticEmail" name="lib" value="{{ old('lib') }}" type="text" placeholder="Entrez le nom du type" required /><small class="ul-form__text form-text" id="passwordHelpBlock">S'il vous plait entrez un nouveau type</small>
                                </div>
                            </div>
                            
                        </div>
                        <div class="card-footer">
                            <div class="mc-footer">
                                <div class="row text-right">
                                    <div class="col-lg-4"></div>
                                    <div class="col-lg-6 text-left">
                                        <button class="btn btn-primary m-1" type="submit">Valider</button>
                                        <button class="btn btn-outline-secondary m-1" type="reset">vider</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end card  Horizontal Form Layout-->
                </form>
            </div>
           
        </div>
        <!-- end::8th section-->
    </div>
</section>
@endsection

@section('javascripts')

@endsection