@extends('main.stock.partials.main')

@section('stylesheets')

@endsection

@section('menuTitle')
Produit
@endsection

@section('pageTitle')
Détail du produit
@endsection

@section('content')
<!--  content goes here -->
<section class="ul-product-detail">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="ul-product-detail__image">
                                @if ($product->image && $product->image_path)
                                    <img style="max-height:450px;" src="{{ asset($product->image_path) }}" alt="alt" />
                                @else
                                    <img src="{{ url('images/product_picture.jpg') }}" alt="alt" />
                                @endif
                                
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="ul-product-detail__brand-name mb-4">
                                <h2 class="heading">{{ $product->lib }}</h2><span class="text-warning">{{ $product->productCategory->lib }}</span>
                            </div>
                            @if ($product->price)
                                <div class="ul-product-detail__price-and-rating d-flex align-items-baseline">
                                    <h5 class="font-weight-700 text-primary mb-0 mr-2">{{ number_format($product->price , 0, '', ' ') }} Fcfa</h5><span class="text-mute font-weight-800 mr-2">
                                        {{-- <del>$1,150</del></span><small class="text-success font-weight-700">50% off</small> --}}
                                </div>
                            @endif
                            
                            <!--
        <div class="ul-product-detail__rating">
                                                        <ul>
                                                            <li></li>
                                                        </ul>
                                                    </div> 
        -->
        <div class="ul-product-detail__features mt-4">
            <h5 class="font-weight-700">Caractéristiques du produit:</h5>
            <ul class="m-0 p-0">
                <div class="ul-widget-app__browser-list-1 mb-2 mt-4"><i class="i-Spell-Check text-white teal-500 rounded-circle p-2 mr-3"></i><span class="text-15"><strong>Référence :</strong> {{ $product->ref }} </span><span class="text-mute" style="display: none">2 April </span></div>
                <div class="ul-widget-app__browser-list-1 mb-2"><i class="i-Check text-white teal-500 rounded-circle p-2 mr-3"></i><span class="text-15"><strong>Stock alerte (seuil) :</strong> {{ $product->stockalert }}</span><span class="text-mute" style="display: none">2 April </span></div>
                @if ($product->typeProduct)
                    <div class="ul-widget-app__browser-list-1 mb-2 "><i class="i-Spell-Check text-white teal-500 rounded-circle p-2 mr-3"></i><span class="text-15"><strong>Type de produit :</strong> {{ $product->typeProduct->lib }}</span><span class="text-mute" style="display: none">2 April </span></div>
                @endif
                @if ($product->poids && $product->unite_poids )
                    <div class="ul-widget-app__browser-list-1 mb-2 "><i class="i-Spell-Check text-white teal-500 rounded-circle p-2 mr-3"></i><span class="text-15"><strong>Poids :</strong> {{ $product->poids }} {{ $product->unite_poids }}</span><span class="text-mute" style="display: none">2 April </span></div>
                @endif
                @if ($product->unite_mesure && $product->longueur)
                    <div class="ul-widget-app__browser-list-1 mb-2 "><i class="i-Spell-Check text-white teal-500 rounded-circle p-2 mr-3"></i><span class="text-15"><strong>Dimensions :</strong> {{ $product->longueur }}x{{ $product->largeur }}x{{ $product->hauteur }} {{ $product->unite_mesure }}</span><span class="text-mute" style="display: none">2 April </span></div>
                @endif
                @if ($product->volume && $product->unite_volume)
                    <div class="ul-widget-app__browser-list-1 mb-2 "><i class="i-Spell-Check text-white teal-500 rounded-circle p-2 mr-3"></i><span class="text-15"><strong>Volume :</strong> {{ $product->volume }} {{ $product->unite_volume }}</span><span class="text-mute" style="display: none">2 April </span></div>
                @endif
                @if ($product->liquide)
                    <div class="ul-widget-app__browser-list-1 mb-2 "><i class="i-Spell-Check text-white teal-500 rounded-circle p-2 mr-3"></i><span class="text-15"><strong>Référence :</strong> {{ $product->liquide }} {{ $product->unite_liquide }}</span><span class="text-mute" style="display: none">2 April </span></div>
                @endif
                @if ($product->status)
                    <div class="ul-widget-app__browser-list-1 mb-2 "><i class="i-Spell-Check text-white teal-500 rounded-circle p-2 mr-3"></i><span class="text-15"><strong>Statut :</strong> {{ $product->status == 1 ? 'Actif': 'Inactif' }}</span><span class="text-mute" style="display: none">2 April </span></div>
                @endif
            
            </ul>
        </div>
                           
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="ul-product-detail__box">
    <div class="row">
            <div class="col-lg-3 col-md-3 mt-4 text-center">
                <a href="{{ route('stock.product.edit',['slug'=>$product->slug]) }}">
                <div class="card">
                    <div class="card-body">
                        <div class="ul-product-detail__border-box">
                            <div class="ul-product-detail--icon mb-2"><i class="i-Edit text-success text-25 font-weight-500"></i></div>
                            <h5 class="heading">Modifier ce produit</h5>
                            <p class="text-muted text-12">Mettre à jour les caractérisques du produit actuel.</p>
                        </div>
                    </div>
                </div>
            </a>
            </div>
        <div class="col-lg-3 col-md-3 mt-4 text-center">
            <a href="#" type="button" data-toggle="modal" data-target="#add_image{{ $product->id }}" data-whatever="@fat">
                <div class="card">
                    <div class="card-body">
                        <div class="ul-product-detail__border-box">
                            <div class="ul-product-detail--icon mb-2"><i class="i-File-Pictures text-primary text-25 font-weight-500"></i></div>
                            <h5 class="heading">Modifier l'image</h5>
                            <p class="text-muted text-12">Mettre à jour l'image du produit actuel.</p>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="modal fade" id="add_image{{ $product->id }}" tabindex="-1" role="dialog" aria-labelledby="add_image{{ $product->id }}" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="add_image{{ $product->id }}_title">Modifier l'image du produit</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    </div>
                    <div class="modal-body">
                        <form method="post" action="{{ route('stock.product.add_image',['slug'=>$product->slug]) }}" enctype="multipart/form-data">
                            @csrf
                            @method('POST')
                            <div class="form-group ">
                                <label class="col-form-label" for="qte">Image </label>       
                                <div class="custom-file">
                                    <input class="custom-file-input" id="inputGroupFile01" type="file" name="image" aria-describedby="inputGroupFileAddon01" />
                                    <label class="custom-file-label" for="inputGroupFile01">Choisir un fichier</label>
                                </div>
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
        {{--<div class="col-lg-3 col-md-3 mt-4 text-center">
            <a href="{{ route('stock.products.index') }}">
            <div class="card">
                <div class="card-body">
                    <div class="ul-product-detail__border-box">
                        <div class="ul-product-detail--icon mb-2"><i class="i-Check text-info text-25 font-weight-500"></i></div>
                        <h5 class="heading">Liste des produits</h5>
                        <p class="text-muted text-12">Afficher la liste de tous les produits en base.</p>
                    </div>
                </div>
            </div>
        </a>
        </div>--}}
        <div class="col-lg-3 col-md-3 mt-4 text-center">
            <a href="#" type="button" data-toggle="modal" data-target="#add_variation{{ $product->id }}" data-whatever="@fat">
            <div class="card">
                <div class="card-body">
                    <div class="ul-product-detail__border-box">
                        <div class="ul-product-detail--icon mb-2"><i class="i-Rotation-390 text-success text-25 font-weight-500"></i></div>
                        <h5 class="heading">Ajouter un mouvement</h5>
                        <p class="text-muted text-12">Effectuer un mouvement de stock pour ce produit</p>
                    </div>
                </div>
            </div>
            </a>
        </div>
        <div class="modal fade" id="add_variation{{ $product->id }}" tabindex="-1" role="dialog" aria-labelledby="add_variation{{ $product->id }}" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="add_variation{{ $product->id }}_title">Effectuer un mouvement de stock</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    </div>
                    <div class="modal-body">
                        <form method="post" action="{{ route('stock.variation.store', ['product'=>$product->id]) }}" enctype="multipart/form-data">
                            @csrf
                            @method('POST')
                            <div class="form-group ">
                                <label class="col-form-label" for="entreprise">Entrepôt:</label>
                                <select name="entreprise" class="form-control" id="entreprise" required>
                                    @forelse (Entreprise::where('status', 1)->orderBy('nom', 'asc')->get() as $data)
                                        <option value="{{ $data->id }}">{{ $data->nom }}</option>
                                    @empty
                                        
                                    @endforelse
                                </select>
                            </div>
                            <div class="form-group ">
                                <label class="col-form-label" for="typemouv">Nature mouvement:</label>
                                <select name="typemouv" class="form-control" id="typemouv" required>
                                        <option value="1">Entrée</option>
                                        <option value="0">Sortie</option>
                                </select>
                            </div>
                            <div class="form-group ">
                                <label class="col-form-label" for="qte">Quantité mouvement:</label>
                                <input class="form-control" id="qte" type="text" name="qte" required/>
                            </div>
                            <div class="form-group ">
                                <label class="col-form-label" for="datemouv">Date mouvement:</label>
                                <input class="form-control" id="datemouv" type="text" name="datemouv" data-inputmask='"mask": "99-99-9999"' data-mask required/>
                            </div>
                            <div class="form-group ">
                                <label class="col-form-label" for="observation">Observation:</label>
                                <textarea name="observation" id="observation" class="form-control"></textarea>
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
        <div class="col-lg-3 col-md-3 mt-4 text-center">
            <a href="{{ route('stock.product.destroy',['slug'=> $product->slug]) }}">
            <div class="card">
                <div class="card-body">
                    <div class="ul-product-detail__border-box">
                        <div class="ul-product-detail--icon mb-2"><i class="i-Close text-danger text-25 font-weight-500"></i></div>
                        <h5 class="heading">Supprimer ce produit</h5>
                        <p class="text-muted text-12">Le produit disparaîtra définitivement de votre liste produits.</p>
                    </div>
                </div>
            </div>
            </a>
        </div>
    </div>
</section>

{{-- <section class="ul-product-detail__tab">
    <div class="row">
        <div class="col-lg-12 col-md-12 mt-4">
            <div class="card mt-2 mb-4">
                <div class="card-body">
                    <nav>
                        <div class="nav nav-tabs" id="nav-tab" role="tablist"><a class="nav-item nav-link active show" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Description</a><a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Reviews</a><a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">Customize Tab</a><a class="nav-item nav-link" id="nav-brand-tab" data-toggle="tab" href="#nav-brand" role="tab" aria-controls="nav-contact" aria-selected="false">About Brand</a></div>
                    </nav>
                    <div class="tab-content ul-tab__content p-5" id="nav-tabContent">
                        <div class="tab-pane fade active show" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                            <div class="row">
                                <div class="col-lg-4 col-md-4 col-sm-12"><img src="{{ url('images/mac_book.jpg') }}" alt="alt" /></div>
                                <div class="col-lg-8 col-md-8 col-sm-12">
                                    <h5 class="text-uppercase font-weight-700 text-muted mt-4 mb-2">Lorem Ipsum is simply dummy text of the printing</h5>
                                    <p>
                                        Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.

                                    </p>
                                    <div class="ul-product-detail__nested-card">
                                        <div class="row text-center">
                                            <div class="col-lg-4 col-sm-12 mb-2">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <div class="ul-product-detail__border-box">
                                                            <div class="ul-product-detail--icon mb-2"><i class="i-Car text-success text-25 font-weight-500"></i></div>
                                                            <h5 class="heading">Quick Delivery</h5>
                                                            <p class="text-muted text-12">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-sm-12 mb-2">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <div class="ul-product-detail__border-box">
                                                            <div class="ul-product-detail--icon mb-2"><i class="i-Car text-primary text-25 font-weight-500"></i></div>
                                                            <h5 class="heading">Quick Delivery</h5>
                                                            <p class="text-muted text-12">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-sm-12 mb-2">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <div class="ul-product-detail__border-box">
                                                            <div class="ul-product-detail--icon mb-2"><i class="i-Car text-danger text-25 font-weight-500"></i></div>
                                                            <h5 class="heading">Quick Delivery</h5>
                                                            <p class="text-muted text-12">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                            <div class="row">
                                <div class="col-12">
                                    <div class="ul-product-detail__avg-rate text-center">
                                        <h3 class="heading text-success">4.9</h3><span class="text-muted font-weight-600">Overall Rating</span>
                                    </div>
                                    <div class="ul-product-detail__comment-list mt-3">
                                        <ul class="list-group list-group-flush">
                                            <li class="list-group-item"><a class="ul-product-detail__reply float-right" href="href"><i class="i-Left"></i><span>Reply</span></a>
                                                <h5 class="font-weight-800">Timothy Clarkson</h5>
                                                <p>Very comfortable key,and nice product.</p><span class="text-warning">**** </span>
                                            </li>
                                            <li class="list-group-item"><a class="ul-product-detail__reply float-right" href="href"><i class="i-Left"></i><span>Reply</span></a>
                                                <h5 class="font-weight-800">Jaret Leto</h5>
                                                <p>Very comfortable key,and nice product.</p><span class="text-warning">**** </span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
                            <div class="ul-product-detail__nested-card mt-2">
                                <div class="row text-center">
                                    <div class="col-lg-4 col-sm-12 mb-2">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="ul-product-detail__border-box">
                                                    <div class="ul-product-detail--icon mb-2"><i class="i-Car text-success text-25 font-weight-500"></i></div>
                                                    <h5 class="heading">Quick Delivery</h5>
                                                    <p class="text-muted text-12">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-sm-12 mb-2">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="ul-product-detail__border-box">
                                                    <div class="ul-product-detail--icon mb-2"><i class="i-Car text-primary text-25 font-weight-500"></i></div>
                                                    <h5 class="heading">Quick Delivery</h5>
                                                    <p class="text-muted text-12">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-sm-12 mb-2">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="ul-product-detail__border-box">
                                                    <div class="ul-product-detail--icon mb-2"><i class="i-Car text-danger text-25 font-weight-500"></i></div>
                                                    <h5 class="heading">Quick Delivery</h5>
                                                    <p class="text-muted text-12">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="nav-brand" role="tabpanel" aria-labelledby="nav-contact-tab">
                            <div class="row">
                                <div class="col-lg-2"><img src="{{ url('images/mac_book.jpg') }}" alt="alt" /></div>
                                <div class="col-lg-6"><span class="badge badge-pill badge-danger p-2 m-1">Apple</span>
                                    <h6 class="heading mt-2">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</h6>
                                    <p class="text-muted">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer</p>
                                </div>
                                <div class="col-lg-4">
                                    <div class="ul-product-detail__features mt-3">
                                        <ul class="m-0 p-0">
                                            <li><i class="i-Right1 text-primary text-15 align-middle font-weight-700"></i><span class="align-middle">This Refurbished product is tested to work and look like new with minimal to no signs of wear & tear</span></li>
                                            <li><i class="i-Right1 text-primary text-15 align-middle font-weight-700"></i><span class="align-middle">2.6GHz Intel Core i5 4th Gen processor</span></li>
                                            <li><i class="i-Right1 text-primary text-15 align-middle font-weight-700"></i><span class="align-middle">8GB DDR3 RAM</span></li>
                                            <li><i class="i-Right1 text-primary text-15 align-middle font-weight-700"></i><span class="align-middle">13.3-inch screen, Intel Iris 5100 1.5GB Graphics</span></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section><!-- end of main-content --> --}}

@endsection

@section('javascripts')
 <script>
     $(document).ready(function() {
         
     });
 </script>
@endsection