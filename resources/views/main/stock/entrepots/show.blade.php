@extends('main.stock.partials.main')

@section('title', 'Détails entrepot -')

@section('stylesheets')
<style>
    label {
        margin-top: 35px;
        margin-bottom: 20px !important;
        display: flex;
        margin-bottom: 0.5rem;
    }
</style>
@endsection

@section('menuTitle')
Entrepôt
@endsection

@section('pageTitle')
Détails de l'entrepôt {{ $entrepot->name }}
@endsection

@section('content')

@php
    $e = $entrepot->entreprise->id;
    $color = ($e == 1) ? 'success' : (($e == 2) ? 'info' : (($e == 3) ? 'primary' : ''));
@endphp
<section class="ul-product-detail">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-4 text-center">
                            <i class="i-Shop{{ $e <> 1 ? '-'.$e : '' }} text-{{ $color }} text-25 font-weight-500" style="font-size: 14em;"></i>
                        </div>
                        <div class="col-lg-8">
                            <div class="ul-product-detail__brand-name mb-4">
                                <h2 class="heading">{{ $entrepot->name }}</h2>
                                <span>{!! $entrepot->description !!}</span>
                            </div>

                            <div class="ul-product-detail__features mt-4">
                                <h5 class="font-weight-700">Caractéristiques :</h5>
                                <ul class="m-0 p-0">
                                    <div class="ul-widget-app__browser-list-1 mb-2 mt-4">
                                        <i class="i-Spell-Check text-white teal-500 rounded-circle p-2 mr-3"></i>
                                        <span class="text-15"><strong>Référence :</strong> {{ $entrepot->reference }} </span>
                                        <span class="text-mute" style="display: none">2 April </span>
                                    </div>
                                    <div class="ul-widget-app__browser-list-1 mb-2">
                                        <i class="i-Spell-Check text-white teal-500 rounded-circle p-2 mr-3"></i>
                                        <span class="text-15"><strong>Lieu :</strong> {{ $entrepot->lieu }} </span>
                                        <span class="text-mute" style="display: none">2 April </span>
                                    </div>
                                    <div class="ul-widget-app__browser-list-1 mb-2 ">
                                        <i class="i-Spell-Check text-white teal-500 rounded-circle p-2 mr-3"></i>
                                        <span class="text-15">
                                            <strong>Entreprise :</strong> 
                                            <img style="height: 2em;" class="mr-1" src="{{ asset($entrepot->entreprise->logo) }}" alt="logo_entreprise" />
                                            {{ $entrepot->entreprise->name }}
                                        </span>
                                        <span class="text-mute" style="display: none">2 April </span>
                                    </div>
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
        @foreach ($products as $product)
            @include('main.stock.product._mouvement', ['type' => 'entrée'])
            @include('main.stock.product._mouvement', ['type' => 'sortie'])
            @include('main.stock.product._transfert')
            <div class="col-md-4 mt-4">
                <div class="card">
                    <div class="card-body p-0">
                        <div class="col-12 text-center p-0 rounded">
                            <a href="{{ route('stock.products.show', $product) }}" class="">
                                @if ($product->image) 
                                    <img class="w-100 rounded-top" src="{{ asset($product->image) }}" alt="alt" />
                                @else
                                    <img class="w-100 rounded-top" src="{{ url('images/product_picture.jpg') }}" alt="alt" />
                                @endif
                            </a>

                            <a href="{{ route('stock.products.show', $product) }}">
                                <p class="m-2 text-18 heading text-truncate" title="{{ $product->name }}">{{ $product->name }}</p>
                            </a>

                            <span class="rounded" style="position: absolute; top:1rem; right: 0rem; background-color: rgba(218, 201, 201, 0.5)"><img class="m-2" src="{{ asset($product->entreprise->logo) }}" alt="" style="height: 3rem;"></span>

                        </div>
                        <div class="col-12 text-center p-2">
                            <h3>
                                <div class="text-muted h5">Stock Physique</div>
                                <div>
                                    {{ number_format($product->stock_physique_entrepot($entrepot), 0, ',', ' ') }}
                                </div>
                            </h3>
                            <h3>
                                <div class="text-muted h5">Stock Virtuel</div>
                                <div>
                                    {{ number_format($product->stock_virtuel_entrepot($entrepot), 0, ',', ' ') }}
                                </div>
                            </h3>
                        </div>

                        <div class="p-2 border-top px-md-2 text-center">
                            {{-- @hasrole(config('constants.roles.geststock'))
                            <a href="" class="btn btn-outline-success m-1" type="button" data-toggle="modal" data-target="#add_variation{{ $product->id }}{{ $entrepot->id }}entrée"><i class="nav-icon i-Down mr-1"></i> Entrée </a>
                            <a href="" class="btn btn-outline-danger m-1" type="button" data-toggle="modal" data-target="#add_variation{{ $product->id }}{{ $entrepot->id }}sortie"><i class="nav-icon i-Up mr-1"></i> Sortie </a>
                            <a href="" class="btn btn-outline-primary m-1" type="button" data-toggle="modal" data-target="#add_variation{{ $product->id }}{{ $entrepot->id }}transfert"><i class="nav-icon i-Data-Transfer mr-1"></i> Transfert </a>
                            @endrole --}}
                            <a href="{{ route('stock.stock_story_entrepot.index',['entrepot'=>$entrepot, 'product'=> $product]) }}" class="btn btn-outline-warning btn-block"><i class="nav-icon i-Repeat-4"></i> Historique </a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</section>

{{-- <div class="row justify-content-center mb-4">
    <div class="col-md-12">
        <div class="card text-left">
            <div class="card-body">
                
                <ul class="nav nav-pills" id="myPillTab" role="tablist">
                    <li class="nav-item"><a class="nav-link active" id="home-icon-pill" data-toggle="pill" href="#infos" role="tab" aria-controls="homePIll" aria-selected="true"><i class="nav-icon i-Home1 mr-1"></i>Infos basiques</a></li>
                    <li class="nav-item"><a class="nav-link" id="profile-icon-pill" data-toggle="pill" href="#inventaire" role="tab" aria-controls="profilePIll" aria-selected="false"><i class="nav-icon i-Box-Full mr-1"></i> Produits</a></li>
                    <li class="nav-item"><a class="nav-link" id="contact-icon-pill" data-toggle="pill" href="#transfert" role="tab" aria-controls="contactPIll" aria-selected="false"><i class="nav-icon i-Data-Transfer mr-1"></i> Transfert de stock</a></li>
                </ul>
                <div class="tab-content" id="myPillTabContent">
                    <div class="tab-pane fade show active" id="infos" role="tabpanel" aria-labelledby="home-icon-pill">
                        <div class="col-lg-6">
                            <div class="ul-product-detail__brand-name mb-4">
                                <h2 class="heading">{{ $entrepot->lib }}</h2>
                            </div>
                            @if ($entrepot->entreprise)
                                <div class="ul-product-detail__price-and-rating d-flex align-items-baseline">
                                    <h5 class="font-weight-700 text-primary mb-0 mr-2">{{ $entrepot->entreprise->name }}</h5><span class="text-mute font-weight-800 mr-2">
                                        
                                </div>
                            @endif
                        
                            <div class="ul-product-detail__features mt-4">
                                <h5 class="font-weight-700">Détails de l'entrepot:</h5>
                                <ul class="m-0 p-0">
                                    <div class="ul-widget-app__browser-list-1 mb-2 mt-4"><i class="i-Spell-Check text-white teal-500 rounded-circle p-2 mr-3"></i><span class="text-15"><strong>Référence :</strong> {{ $entrepot->reference }} </span><span class="text-mute" style="display: none">2 April </span></div>
                                    <div class="ul-widget-app__browser-list-1 mb-2"><i class="i-Check text-white teal-500 rounded-circle p-2 mr-3"></i><span class="text-15"><strong>Entreprise :</strong> {{ $entrepot->entreprise->name }}</span><span class="text-mute" style="display: none">2 April </span></div>
                                    <div class="ul-widget-app__browser-list-1 mb-2"><i class="i-Check text-white teal-500 rounded-circle p-2 mr-3"></i><span class="text-15"><strong>Lieu :</strong> {{ $entrepot->lieu }}</span><span class="text-mute" style="display: none">2 April </span></div>
                                    <div class="ul-widget-app__browser-list-1 mb-2"><i class="i-Spell-Check text-white teal-500 rounded-circle p-2 mr-3"></i><span class="text-15"><strong>Contact :</strong> {{ $entrepot->contact }} </span><span class="text-mute" style="display: none">2 April </span></div>
                                </ul>
                            </div>
                           
                        </div>

                    </div>
                    <div class="tab-pane fade" id="inventaire" role="tabpanel" aria-labelledby="profile-icon-pill">
                        <div class="table-responsive">
                            <table class="display table table-striped table-bordered table_oholiab" style="width:100%">
                                <thead>
                                    <tr>

                                        <!-- @php                                    
                                        $qtecmde= DB::table('variations')->distinct()
                                        ->join('products', 'products.id', '=', 'variations.id_product')
                                        ->join('ligne_commandes', 'products.id', '=', 'ligne_commandes.product_id')
                                        ->join('commandes', 'commandes.id', '=', 'ligne_commandes.commande_id')
                                        ->join('entrepots', 'entrepots.id', '=', 'variations.id_entrepot')
                                        ->join('products_categories', 'products_categories.id', '=', 'products.id_product_category')
                                        ->where('variations.status', '=', 1)
                                        ->where('products.status', '=', 1)
                                        ->select('products.lib as prod','products_categories.lib as category','ligne_commandes.qte  as quantite',
                                        DB::raw('SUM(variations.qte_entree) as total_entree'),
                                        DB::raw('SUM(variations.qte_sortie) as total_sortie'),
                                        DB::raw('SUM(variations.qte_entree) - SUM(variations.qte_sortie) as total_stock'))
                                        ->where('variations.id_entreprise', '=', 1)
                                        ->where('products.id', '=', $data->id)
                                        ->whereIn('commandes.status', [0,1])
                                        ->groupBy('ligne_commandes.id')->get();    
                                    @endphp -->

                                        <th>Référence</th>
                                        <th>Libéllé</th>
                                        <th>Catégorie</th>
                                        <th>Seuil</th>
                                        <th>Stock physique</th>
                                        <th>Stock virtuel</th>
                                        <th>Etat du stock</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody> 
                                    @forelse ($products as $product)
                                        <tr>
                                            <td>{{ $product->reference }}</td>
                                            <td>{{ $product->name }}</td>
                                            <td>{{ $product->category->name }}</td>
                                            <td>
                                                @if ($product->total_stock < $product->stockalert)
                                                <strong style="color: red">{{ $product->stockalert }}</strong>
                                                @else
                                                <strong style="color: green">{{ $product->stockalert }}</strong>
                                                @endif
                                            </td>
                                            <td>{{ $product->stock_physique_entrepot($entrepot) }}</td>
                                            <td>{{ $product->stock_virtuel_entrepot($entrepot) }}</td>
                                            <td>
                                                @if ($product->stock_virtuel_entrepot($entrepot) < $product->stockalert)
                                                <a class="badge badge-danger text-white m-2 p-2">Rupture </a>
                                                @else
                                                <a class="badge badge-success text-white m-2 p-2">Disponible</a>
                                                @endif
                                             </td>
                                            <td>
                                                <button class="btn btn-outline-success m-1" type="button" data-toggle="modal" data-target="#verifyModalContent{{ $product->id }}" data-whatever="@fat">Modifier</button>
                                                <a href="{{ route('stock.stock_story_entrepot.index',['entrepot'=>$entrepot, 'product'=> $product]) }}">
                                                    <button class="btn btn-outline-warning m-1" type="button">Historique</button>
                                                </a>
                                                <!-- <a href="{{ route('stock.products.destroy', $product) }}"><button class="btn btn-outline-danger m-1" type="button">Supprimer</button></a> -->
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>

                                        </tr>
                                    @endforelse
                                </tbody>
                                <tfoot>
                                    <tr>    
                                        <th>Référence</th>
                                        <th>Libéllé</th>
                                        <th>Catégorie</th>
                                        <th>Seuil</th>
                                        <th>Stock physique</th>
                                        <th>Stock virtuel</th>
                                        <th>Etat du stock</th>
                                        <th>Action</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>

                    </div>
                    <div class="tab-pane fade" id="transfert" role="tabpanel" aria-labelledby="contact-icon-pill">
                        <div class="card-title mb-1">Transférer des produits vers un autre entrepôt</div>
                        <form method="post" action="{{ route('stock.entrepots.store')}}">
                            @csrf
                            @method('POST')
                            
                            <div class="row">
                                <div class="col-md-3 form-group mb-2">
                                    <label for="source">Entrepôt source</label>
                                    <input class="form-control @error('source') is-invalid @enderror" id="source" name="id_entrepot_source" value="{{ $entrepot->name }}" type="text" required readonly />
                                    @if ($errors->has('source'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('source') }}
                                        </div>
                                    @endif
                                </div>
                                <div class="col-md-3 form-group mb-2">
                                    <label for="destination">Entrepôt destination</label> 
                                    <select name="id_entrepot_destination" id="destination" class="form-control @error('destination') is-invalid @enderror" required>
                                        <option value="0" disabled selected>Choisir un entrepôt</option>
                                        @forelse ($entrepot->voisins() as $data)
                                        <option value="{{ $data->id }}">{{ $data->name }}</option>
                                        @empty
                                            
                                        @endforelse
                                    </select>                            
                                    @if ($errors->has('destination'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('destination') }}
                                        </div>
                                    @endif
                                </div>
                                <div class="col-md-3 form-group mb-2">
                                    <label for="product">Produits</label> 
                                    <select name="product" id="product" class="form-control @error('product') is-invalid @enderror" required>
                                        <option value="0" disabled selected>Choisir un produit</option>
                                        @forelse ($entrepot->products() as $data)
                                        <option value="{{ $data->id }}">{{ $data->name }}</option>
                                        @empty
                                            
                                        @endforelse
                                    </select>                            
                                    @if ($errors->has('product'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('id_entreprise') }}
                                        </div>
                                    @endif
                                </div>
                                <div class="col-md-3 form-group mb-2">
                                    <label for="qte">Quantité</label>
                                    <input class="form-control @error('qte') is-invalid @enderror" id="qte" name="qte" value="{{ old('qte') }}" type="text" placeholder="Entrez le libellé de l'entrepôt" required />
                                    @if ($errors->has('qte'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('qte') }}
                                        </div>
                                    @endif
                                </div>
                                <div class="col-md-12 mt-3">
                                    <button class="btn btn-primary">Valider</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</div> --}}
@endsection

@section('javascripts')

<script>
    $('[data-mask]').inputmask();
</script>

@endsection