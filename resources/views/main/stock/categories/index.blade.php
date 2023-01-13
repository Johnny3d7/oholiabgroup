@extends('main.stock.partials.main')

@section('title', 'Liste catégories -')

@section('stylesheets')

@endsection

@section('menuTitle')
Catégories produit
@endsection

@section('pageTitle')
Liste  des catégories
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
                        <div class="card-title">Liste des catégories de produit</div>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">ID</th>
                                        <th scope="col">Libellé</th>
                                        <th scope="col">Commercialisable</th>
                                        {{-- <th scope="col">Action</th> --}}
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($productCategory as $category)
                                        <tr>
                                            <th scope="row">{{ $category->id }}</th>
                                            <td><span class="text-15 font-weight-200">{{ $category->name }}</span><br /></td>
                                            <td><span class="text-15 font-weight-200">
                                                @if ($category->commercialisable == 1)
                                                    Oui
                                                @else
                                                    Non
                                                @endif
                                                
                                            </span><br /></td>
                                            {{-- <td>
                                                <button class="btn btn-outline-success m-1" type="button" data-toggle="modal" data-target="#verifyModalContent{{ $category->id }}" data-whatever="@fat">Modifier</button>
                                                <a href="{{ route('stock.categories.destroy', $category) }}">
                                                    <button class="btn btn-outline-danger m-1" type="button">Supprimer</button>
                                                </a>
                                            </td> --}}
                                        </tr>
                                        <div class="modal fade" id="verifyModalContent{{ $category->id }}" tabindex="-1" role="dialog" aria-labelledby="verifyModalContent{{ $category->id }}" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="verifyModalContent{{ $category->id }}_title">Modification de la catégorie {{ $category->lin }}</h5>
                                                        <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form method="put" action="{{ route('stock.categories.update', $category)}}">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="form-group">
                                                                <label class="col-form-label" for="recipient-name-3{{ $category->id }}">Libellé:</label>
                                                                <input class="form-control" value="{{ $category->lib }}" id="recipient-name-3{{ $category->id }}" type="text" name="lib"/>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label class="switch pr-5 switch-success ml-3 mt-3"><span>Catégorie de produits commercialisable</span>
                                                                    <input type="checkbox" @if ($category->commercialisable == 1) checked @endif  name="commercialisable" /><span class="slider"></span>
                                                                </label>
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
                <form method="POST" action="{{ route('stock.categories.store')}}">
                    <!-- start card  Horizontal Form Layout-->
                    @csrf
                    @method('POST')
                    <!-- start card  Horizontal Form Layout-->
                    <div class="card ul-card__margin-25">
                        <div class="card-header bg-transparent">
                            <h3 class="card-title">Ajouter une nouvelle catégorie</h3>
                        </div>
                        <div class="card-body">
                            <div class="form-group row">
                                <label class="action-bar-horizontal-label col-lg-4 col-form-label" for="lib">Libellé</label>
                                <div class="col-lg-6 mb-4">
                                    <input class="form-control" id="lib" name="lib" type="text" placeholder="Entrez le nom de la catégorie" />
                                    @if ($errors->has('lib'))
                                    <div class="text-danger">
                                        <small class="ul-form__text form-text text-danger" id="passwordHelpBlock">{{ $errors->first('lib') }}</small>
                                    </div>
                                    @else    
                                    <small class="ul-form__text form-text" id="passwordHelpBlock">S'il vous plait entrez une nouvelle catégorie</small>
                                    @endif
                                </div>
                                
                            </div>
                            <div class="form-group row">
                                <label class="switch pr-5 switch-success ml-3"><span>Catégorie de produits commercialisable</span>
                                    <input type="checkbox" name="commercialisable" /><span class="slider"></span>
                                </label>
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