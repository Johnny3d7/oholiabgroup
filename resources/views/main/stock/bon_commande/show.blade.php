@extends('main.stock.partials.main')

@section('stylesheets')

@endsection

@section('menuTitle')
Commande
@endsection

@section('pageTitle')
Bon de commande
@endsection

@section('content')
<!-- section 1-->
<section class="ul-widget-stat-s1">
    <div class="row">
        
        <div class="col-lg-9">
            <div class="card">
                <div class="card-body">
                    <div class="card-title">Détails du bon de commande</div><span class="text-muted"></span>
                    <div class="row">
                        <div class="col-lg-12 mt-1">
                            <div class="ul-product-cart__invoice">
                                <div class="card-title">
                                    <h3 class="heading text-primary">BON COMMANDE</h3>
                                   {{-- @if (strpos(strtolower($bonCommande->products->first()->category->lib), 'obp'))
                                    <img class="logo" style="height: 50px; width:auto; float:right !important; margin-top:-40px !important;" src="{{ url('images/logoobp.png') }}" alt="">
                                    @elseif(strpos(strtolower($bonCommande->products->first()->category->lib), 'ak'))
                                    <img class="logo" style="height: 120px; width:auto; float:right !important; margin-top:-80px !important;" src="{{ url('images/logoakebie.png') }}" alt="">
                                    @endif --}} 
                                </div>
                                <div>
                                </div>
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <th class="text-16 text-muted" scope="row">Statut</th>
                                            
                                                @if ($bonCommande->status == 0)
                                                <td class="text-16 text-primary font-weight-700">
                                                    Attente validation
                                                </td> 
                                                @elseif($bonCommande->status == 1 )
                                                <td class="text-16 text-warning font-weight-700">
                                                    Bon pour accord
                                                </td>
                                                @elseif($bonCommande->status == 2)
                                                <td class="text-16 text-danger font-weight-700">
                                                    Rejetté
                                                </td>
                                                @endif                                           
                                        </tr>
                                        
                                        <tr>
                                            <th class="text-16 text-muted" scope="row">Accord d'achat</th>
                                            @if ($bonCommande->accord_achat == 1)
                                                <td class="text-16 text-success font-weight-700">
                                                    Validé
                                                </td>
                                            @elseif($bonCommande->accord_achat == 0)
                                                <td class="text-16 text-success font-weight-700">
                                                    Non validé
                                                </td> 
                                            @endif
                                              
                                            <th class="text-16" scope="row">&nbsp;&nbsp;&nbsp;Date de création</th>
                                            <td class="text-16 text-success font-weight-700">
                                                {{ ucwords((new Carbon\Carbon($bonCommande->created_at))->locale('fr')->isoFormat('DD/MM/YYYY')) }}
                                            </td>
                                        </tr>
                                        @if ($bonCommande->date_livraison)
                                            <tr>
                                                <th class="text-16 text-muted" scope="row">Date livraison</th>
                                                <td class="text-16 text-success font-weight-700">
                                                    {{ $bonCommande->date_livraison }}

                                                </td>
                                                <th class="text-16 text-muted" scope="row">Lieu livraison</th>
                                                <td class="text-16 text-success font-weight-700">
                                                    +225 {{ $bonCommande->lieu_livraison }}
                                                </td>                                           
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                                <div class="card-title">
                                    <h3 class="heading text-primary">FOURNISSEUR</h3>
                                </div>
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <th class="text-16 text-muted" scope="row">Nom</th>
                                            <td class="text-16 text-success font-weight-700">
                                                {{ $bonCommande->fournisseur->nom }}

                                            </td>
                                            <th class="text-16 text-muted" scope="row">Contact&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                            <td class="text-16 text-success font-weight-700">
                                                +225 {{ $bonCommande->fournisseur->contact }}
                                            </td>                                           
                                        </tr>
                                        
                                        <tr>
                                            <th class="text-16 text-muted" scope="row">Email</th>
                                            <td class="text-16 text-success font-weight-700">
                                                {{ $bonCommande->fournisseur->email }}
                                            </td>   
                                            <th class="text-16" scope="row">Type fournisseur</th>
                                            <td class="text-16 text-success font-weight-700">
                                                @if ($bonCommande->fournisseur->typeFournisseur)
                                                {{ $bonCommande->fournisseur->typeFournisseur->lib }}
                                                @else
                                                    
                                                @endif
                                              

                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="row">
                <div class="col-lg-12 col-md-6 col-sm-6">
                    <div class="card card-icon-bg card-icon-bg-primary o-hidden mb-4">
                        <div class="card-body text-center"><i class="i-Car-Items"></i>
                            <div class="content">
                                <p class="text-muted mt-2 mb-0">Produits</p>
                                <p class="text-primary text-24 line-height-1 mb-2">{{ $bonCommande->products()->wherePivot('status',1)->count() }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                {{--<div class="col-lg-12 col-md-6 col-sm-6">
                    <div class="card card-icon-bg card-icon-bg-primary o-hidden mb-4">
                        <div class="card-body text-center"><i class="i-Money-2"></i>
                            <div class="content">
                                <p class="text-muted mt-2 mb-0">Montant</p>
                                
                                <p class="text-primary text-16 line-height-1 mb-2">
                                            <?php /* $mttc = 0;*/ ?>
                                           
                                            @foreach ($bonCommande->products as $data) 
                                            <?php /* $mttc += $data->pivot->qte * $data->pivot->prix; */ ?>
                                            @endforeach
                                            {{ number_format($mttc, 0, '', '.') }}&nbsp;Fcfa
                                </p>
                            </div>
                        </div>
                    </div>
                </div>  --}}
                <div class="col-lg-12 col-md-6 col-sm-6">
                    <div class="card mb-4">
                        <div class="card-body">
                            <h6 class="mb-2 text-muted">Progression</h6>
                            @if ($bonCommande->status == 0)
                            <p class="mb-1 text-22 font-weight-light">50%</p>
                            <div class="progress mb-1" style="height: 4px">
                                <div class="progress-bar bg-primary" style="width: 50%" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                            </div><small class="text-muted">Attente validation</small>
                            @elseif($bonCommande->status == 1)
                            <p class="mb-1 text-22 font-weight-light">100%</p>
                            <div class="progress mb-1" style="height: 4px">
                                <div class="progress-bar bg-success" style="width: 100%" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                            </div><small class="text-muted">Attente de livraison</small>
                            @elseif($bonCommande->status == 2)
                            <p class="mb-1 text-22 font-weight-light">0%</p>
                            <div class="progress mb-1" style="height: 4px">
                                <div class="progress-bar bg-danger" style="width: 0%" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                            </div><small class="text-muted">Rejetée</small>
                            @endif
                            
                        </div>
                    </div>
                </div>
                {{--  --}}<div class="col-lg-12 col-md-6 col-sm-6 mb-4">
                    <a href="#" type="button" data-toggle="modal" data-target="#importProforma{{ $bonCommande->id }}" data-whatever="@fat">
                    <div class="p-4 rounded d-flex align-items-center bg-info proforma text-white"><i class="i-Upload text-32 mr-3"></i>
                        <div>
                            <h4 class="text-18 mb-1 text-white">PRO-FORMA</h4><span>Importer ici</span>
                        </div>
                    </div>
                    </a>
                    <div class="modal fade" id="importProforma{{ $bonCommande->id }}" tabindex="-1" role="dialog" aria-labelledby="importProforma{{ $bonCommande->id }}" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="importProforma{{ $bonCommande->id }}_title">Attaché une PRO-FORMA au bon de commande</h5>
                                    <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                </div>
                                <div class="modal-body">
                                    <form method="put" action="{{ route('boncommande.add_proforma',['id'=> $bonCommande->id])}}" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <div class="form-group ">
                                            <label class="col-form-label" for="proforma">Pro-forma</label>
                                            <input  type="file" name="proforma" />
                                        </div>
                                        <div class="form-group ">
                                            <input class="form-control" value="{{ $bonCommande->id }}" name="bon_commande_id" id="bon_commande_id" type="text" hidden/>
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
                </div>
                <div class="col-lg-12 col-md-6 col-sm-6 mb-4">
                    <a href="{{ asset($bonCommande->proforma_path) }}">
                    <div class="p-4 rounded d-flex align-items-center bg-success proforma text-white"><i class="i-Data-Download text-32 mr-3"></i>
                        <div>
                            <h4 class="text-18 mb-1 text-white">PRO-FORMA</h4><span>Télecharger ici</span>
                        </div>
                    </div>
                </a>
                </div>
            </div>
           
        </div>
    </div>
    <div class="row mt-5">
        <div class="col-lg-9">
            <div class="card text-left">
                <div class="card-header text-right bg-transparent">
                    <button class="btn btn-outline-success m-1" type="button" data-toggle="modal" data-target="#verifyModalContent{{ $bonCommande->id }}" data-whatever="@fat">Ajouter un produit</button> 
                </div>
                <div class="modal fade" id="verifyModalContent{{ $bonCommande->id }}" tabindex="-1" role="dialog" aria-labelledby="verifyModalContent{{ $bonCommande->id }}" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="verifyModalContent{{ $bonCommande->id }}_title">Ajout d'un produit au bon de commande</h5>
                                <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                            </div>
                            <div class="modal-body">
                                <form method="post" action="{{ route('bon_commande_fournisseur.add_Product')}}">
                                    @csrf
                                    @method('POST')
                                    <div class="form-group ">
                                        <label class="col-form-label" for="product">Produit</label>
                                        <select name="product"  class="form-control produit" id="product">
                                            <option value=""  selected>-- Sélectionner --</option>
                                            @if ($bonCommande->fournisseur->id == 1 || $bonCommande->fournisseur->id == 2)
                                                @forelse (Product::where(['status'=> 1, 'id_product_category' => $bonCommande->fournisseur->id])->orderBy('lib', 'asc')->get() as $data)
                                                <option value="{{ $data->id }}">{{ $data->lib }}</option>
                                                @empty
                                                
                                                @endforelse
                                            @else
                                                @forelse (Product::where('status', 1)->whereNotIn('id_product_category',[1,2])->orderBy('lib', 'asc')->get() as $data)
                                                <option value="{{ $data->id }}">{{ $data->lib }}</option>
                                                @empty
                                                
                                                @endforelse
                                            @endif
                                            
                                        </select>
                                    </div>
                                    <div class="form-group ">
                                        <label class="col-form-label" for="prix">Prix</label>
                                        <input class="form-control" value="{{ old('prix') }}" name="prix" id="prix" type="number" placeholder="Ex: 150"/>
                                    </div>
                                    <div class="form-group ">
                                        <label class="col-form-label" for="qte">Quantité</label>
                                        <input class="form-control" value="{{ old('qte') }}" name="qte" id="qte" type="number" placeholder="Ex: 150"/>
                                    </div>
                                    <div class="form-group ">
                                        <input class="form-control" value="{{ $bonCommande->id }}" name="bon_commande_id" id="bon_commande_id" type="text" hidden/>
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
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="display table" id="ul-contact-list" style="width:100%">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Libellé</th>
                                    <th>prix</th>
                                    <th>Quantité</th>
                                    <th>Sous total</th>
                                    <th>Seuil</th>
                                    <th>Stock virtuel</th>
                                    <th>Statut</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $valider = true ?>
                                @forelse ($bonCommande->products as $data)
                                @if ($data->pivot->status == 1)
                                <tr>
                                    @php
                                        $product = DB::table('variations')->distinct()
                                        ->join('products', 'products.id', '=', 'variations.id_product')
                                        ->join('entreprises', 'entreprises.id', '=', 'variations.id_entreprise')
                                        ->join('products_categories', 'products_categories.id', '=', 'products.id_product_category')
                                        ->select('products.*','products_categories.lib as category',
                                        DB::raw('SUM(variations.qte_entree) as total_entree'),
                                        DB::raw('SUM(variations.qte_sortie) as total_sortie'),
                                        DB::raw('SUM(variations.qte_entree) - SUM(variations.qte_sortie) as total_stock'))
                                        ->where('variations.id_entreprise', '=', 1)
                                        ->where('products.id', '=', $data->id)
                                        ->groupBy('products.id')->get();
                                        
                                        $qtecmde= DB::table('variations')->distinct()
                                        ->join('products', 'products.id', '=', 'variations.id_product')
                                        ->join('ligne_commandes', 'products.id', '=', 'ligne_commandes.product_id')
                                        ->join('commandes', 'commandes.id', '=', 'ligne_commandes.commande_id')
                                        ->join('entreprises', 'entreprises.id', '=', 'variations.id_entreprise')
                                        ->join('products_categories', 'products_categories.id', '=', 'products.id_product_category')
                                        ->select('products.lib as prod','products_categories.lib as category','ligne_commandes.qte  as quantite',
                                        DB::raw('SUM(variations.qte_entree) as total_entree'),
                                        DB::raw('SUM(variations.qte_sortie) as total_sortie'),
                                        DB::raw('SUM(variations.qte_entree) - SUM(variations.qte_sortie) as total_stock'))
                                        ->where('variations.id_entreprise', '=', 1)
                                        ->where('products.id', '=', $data->id)
                                        ->whereIn('commandes.status', [0,1])
                                        ->groupBy('ligne_commandes.id')->get();    
                                    @endphp

                                    <?php $total_qte_cmde = 0; ?>
                                    @foreach ($qtecmde as $ligne)
                                    <?php 
                                        $total_qte_cmde += $ligne->quantite; 
                                    ?>
                                    @endforeach
                                    {{-- Stock virtuelle --}}
                                    <?php $stock_virtuel = $product[0]->total_stock - $total_qte_cmde; ?>

                                
                                    <td>{{ $data->ref }}</td>
                                    <td>{{ $data->lib }}</td>
                                    <td>{{ $data->pivot->prix }} Fcfa</td>
                                    <td>{{ $data->pivot->qte }}</td>
                                    <td>{{ $data->pivot->qte * $data->pivot->prix  }} Fcfa</td>
                                    <td>{{ $data->stockalert }}</td>
                                    <td>{{ $stock_virtuel }}</td>
                                    <td>
                                        @if ($stock_virtuel < $data->stockalert)
                                        <?php $valider = false ?>
                                        <a class="badge badge-danger m-2 p-2" href="#">rupture</a>
                                        @else
                                        <a class="badge badge-success m-2 p-2" href="#">Disponible</a>
                                        @endif  
                                    </td>
                                    <td><button class="btn btn-outline-success m-1" type="button" data-toggle="modal" data-target="#updateModalContent{{ $data->id }}" data-whatever="@fat">Modifier</button><a href="{{ route('bon_commande_fournisseur.delete_Product',['bonCommande'=>$bonCommande->id,'product'=>$data->id]) }}"><button class="btn btn-outline-danger m-1" type="button" data-whatever="@fat">supprimer</button></a></td>
                                </tr>
                                <div class="modal fade" id="updateModalContent{{ $data->id }}" tabindex="-1" role="dialog" aria-labelledby="updateModalContent{{ $data->id }}" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="updateModalContent{{ $data->id }}_title">Modifier la quantité commandé</h5>
                                                <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                            </div>
                                            <div class="modal-body">
                                                <form method="put" action="{{ route('bon_commande_fournisseur.update_Product',['bonCommande'=>$bonCommande->id,'product'=>$data->id])}}">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="form-group ">
                                                        <label class="col-form-label" for="product">Produit</label>
                                                        <select name="product" disabled  class="form-control produit" id="product">
                                                            <option>-- Sélectionner --</option>
                                                            @forelse (Product::where(['status'=> 1])->orderBy('lib', 'asc')->get() as $prod)
                                                                @if ($data->id == $prod->id)
                                                                    <option selected value="{{ $prod->id }}">{{ $prod->lib }}</option>
                                                                @else
                                                                    <option value="{{ $prod->id }}">{{ $prod->lib }}</option>
                                                                @endif
                                                            @empty
                                                                
                                                            @endforelse
                                                        </select>
                                                    </div>
                                                    <div class="form-group ">
                                                        <label class="col-form-label" for="prix">Prix</label>
                                                        <input class="form-control" value="{{ $data->pivot->prix }}" name="prix" id="prix" type="number" placeholder="Ex: 1500"/>
                                                    </div>
                                                    <div class="form-group ">
                                                        <label class="col-form-label" for="qte">Quantité</label>
                                                        <input class="form-control" value="{{ $data->pivot->qte }}" name="qte" id="qte" type="number" placeholder="Ex: 150"/>
                                                    </div>
                                                    <div class="form-group ">
                                                        <input class="form-control" value="{{ $bonCommande->id }}" name="commande_id" id="commande_id" type="text" hidden/>
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
                                @endif
                                     
                                @empty
                                    
                                @endforelse
                                            
                             </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="card">
                <div class="card-body">
                    <div class="ul-widget__head v-margin pb-20">
                        <div class="ul-widget__head-label">
                            <h3 class="ul-widget__head-title">Actions</h3>
                        </div>
                        
                    </div>
                    <div class="ul-widget__body">
                        <div class="__g-widget4">
                            @if ($bonCommande->status == 0)
                               
                                <div class="ul-widget4__item">
                                    <div class="ul-widget4__pic-icon"><i class="i-Yes text-success"></i></div><a class="ul-widget4__title" href="{{ route('commande_client.valider',['slug'=> $bonCommande->id]) }}">Valider bon de commande</a>
                                </div>                            
                        
                                <div class="ul-widget4__item">
                                    <div class="ul-widget4__pic-icon"><i class="i-Close text-danger"></i></div><a class="ul-widget4__title" href="{{ route('commande_client.rejeter',['slug'=> $bonCommande->id]) }}">Rejeter bon de commande</a>
                                </div>
                                <div class="ul-widget4__item">
                                    <div class="ul-widget4__pic-icon"><i class="i-Close text-danger"></i></div><a class="ul-widget4__title" href="{{ route('commande_client.destroy',['slug'=> $bonCommande->id]) }}">Supprimer bon de commande</a>
                                </div>
                            @endif
                            
                            @if ($bonCommande->status == 1)
                            
                            <div class="ul-widget4__item">
                                <div class="ul-widget4__pic-icon"><i class="i-Close text-danger"></i></div><a class="ul-widget4__title" href="{{ route('commande_client.rejeter',['slug'=> $bonCommande->id]) }}">Rejeter bon de commande</a>
                            </div>
                                <div class="ul-widget4__item">
                                    <div class="ul-widget4__pic-icon"><i class="i-Close text-danger"></i></div><a class="ul-widget4__title" href="{{ route('commande_client.destroy',['slug'=> $bonCommande->id]) }}">Supprimer la commande</a>
                                </div>
                            @endif

                            @if ($bonCommande->status == 2)
                            <div class="ul-widget4__item">
                                <div class="ul-widget4__pic-icon"><i class="i-Yes text-success"></i></div><a class="ul-widget4__title" href="{{ route('commande_client.valider',['slug'=> $bonCommande->id]) }}">Valider bon de commande</a>
                            </div> 
                                <div class="ul-widget4__item">
                                    <div class="ul-widget4__pic-icon"><i class="i-Close text-danger"></i></div><a class="ul-widget4__title" href="{{ route('commande_client.destroy',['slug'=> $bonCommande->id]) }}">Supprimer la commande</a>
                                </div>
                            @endif
                             <div class="modal fade" id="livraisonModalContent{{ $bonCommande->id }}" tabindex="-1" role="dialog" aria-labelledby="livraisonModalContent{{ $bonCommande->id }}" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="livraisonModalContent{{ $bonCommande->id }}_title">Créer un bon de livraison</h5>
                                            <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                        </div>
                                        <div class="modal-body">
                                            <form method="post" action="{{ route('commande_client.create_bon_livraison')}}">
                                                @csrf
                                                @method('POST')
                                                <div class="form-group ">
                                                    <label class="col-form-label" for="nom_livreur">Nom du livreur</label>
                                                    <input class="form-control"  name="nom_livreur" id="nom_livreur" type="text" placeholder="Ex: Irébé daniel "/>
                                                </div>
                                                <div class="form-group ">
                                                    <label class="col-form-label" for="numero_vehicule">Numéro du véhicule</label>
                                                    <input class="form-control"  name="numero_vehicule" id="numero_vehicule" type="text" placeholder="Ex: 9857JN01"/>
                                                </div>
                                                <div class="form-group ">
                                                    <input class="form-control" value="{{ $bonCommande->id }}" name="commande_id" id="commande_id" type="text" hidden/>
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- end:: section 1-->

   

@endsection

@section('javascripts')
 <script>
     $(document).ready(function() {
         $('.updateproduct').click( function (e) {
             e.preventDefault();
         })

         $(".proforma:hover").removeClass('bg-info');
         $(".proforma:hover").addClass('bg-success');
     });
 </script>
@endsection