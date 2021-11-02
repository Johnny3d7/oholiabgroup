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
                    <div class="card-title">Détails de la commande</div><span class="text-muted"></span>
                    <div class="row">
                        <div class="col-lg-12 mt-1">
                            <div class="ul-product-cart__invoice">
                                <div class="card-title">
                                    <h3 class="heading text-primary">BON DE COMMANDE INTERNE</h3>
                                </div>
                                <div>
                                </div>
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <th class="text-16 text-muted" scope="row">Statut</th>
                                            <td class="text-16 text-primary font-weight-700">
                                                N° {{ $commande->num_cmd }}
                                            </td> 
                                            <th class="text-16 text-muted" scope="row">Statut</th>
                                            
                                                @if ($commande->status == 0)
                                                <td class="text-16 text-primary font-weight-700">
                                                    Attente validation
                                                </td> 
                                                @elseif($commande->status == 1 )
                                                <td class="text-16 text-warning font-weight-700">
                                                    @if (Auth::user()->entreprise->id == $commande->id_entreprise)
                                                        Bon pour accord 
                                                    @elseif(Auth::user()->entreprise->id == $commande->id_fournisseur)
                                                        Attente de validation
                                                    @endif
                                                    
                                                </td>
                                                @elseif($commande->status == 7)
                                                <td class="text-16 text-warning font-weight-700">
                                                    @if (Auth::user()->entreprise->id == $commande->id_entreprise)
                                                        Validée par le fournisseur
                                                    @elseif(Auth::user()->entreprise->id == $commande->id_fournisseur)
                                                        Validée
                                                    @endif
                                                </td>
                                                @elseif($commande->status == 2)
                                                <td class="text-16 text-warning font-weight-700">
                                                    @if (Auth::user()->entreprise->id == $commande->id_entreprise)
                                                        Attente de livraison
                                                    @elseif(Auth::user()->entreprise->id == $commande->id_fournisseur)
                                                        Livraison en cours
                                                    @endif
                                              
                                                </td>
                                                @elseif($commande->status == 3)
                                                <td class="text-16 text-success font-weight-700">
                                                    Livrée
                                                </td>
                                                @elseif($commande->status == 4)
                                                <td class="text-16 text-danger font-weight-700">
                                                    Rejettée
                                                </td>
                                                @elseif($commande->status == 5)
                                                <td class="text-16 text-danger font-weight-700">
                                                    Annulée
                                                </td>
                                                @elseif($commande->status == 8)
                                                    <td class="text-16 text-danger font-weight-700">
                                                        @if (Auth::user()->entreprise->id == $commande->id_entreprise)
                                                            Rejeter (fournisseur)
                                                        @elseif(Auth::user()->entreprise->id == $commande->id_fournisseur)
                                                            Rejeter
                                                        @endif
                                                
                                                    </td>
                                                @endif                                           
                                        </tr>
                                        
                                        <tr>
                                            <th class="text-16 text-muted" scope="row">Accord d'achat</th>
                                          
                                                <td class="text-16 text-success font-weight-700">
                                                    @if ($commande->status == 1 || $commande->status == 2 || $commande->status == 3 || $commande->status == 7)
                                                        Validé
                                                    @else
                                                        Non validé
                                                    @endif
                                                </td>
                                            
                                              
                                            <th class="text-16" scope="row">&nbsp;&nbsp;&nbsp;Date de création</th>
                                            <td class="text-16 text-success font-weight-700">
                                                {{ ucwords((new Carbon\Carbon($commande->created_at))->locale('fr')->isoFormat('DD/MM/YYYY')) }}
                                            </td>
                                        </tr>
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
                                                {{ $commande->fournisseur->nom }}

                                            </td>
                                            <th class="text-16 text-muted" scope="row">Contact&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                            <td class="text-16 text-success font-weight-700">
                                                +225 {{ $commande->fournisseur->contact }}
                                            </td>                                           
                                        </tr>
                                        
                                        <tr>
                                            <th class="text-16 text-muted" scope="row">Email</th>
                                            <td class="text-16 text-success font-weight-700">
                                                {{ $commande->fournisseur->email }}
                                            </td>   
                                            <th class="text-16" scope="row">Type fournisseur</th>
                                            <td class="text-16 text-success font-weight-700">
                                                @if ($commande->fournisseur->typeFournisseur)
                                                {{ $commande->fournisseur->typeFournisseur->lib }}
                                                @else
                                                    
                                                @endif
                                              

                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                @if (Auth::user()->entreprise->id == $commande->id_fournisseur)
                                <div class="card-title">
                                    <h3 class="heading text-primary">CLIENT</h3>
                                </div>
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <th class="text-16 text-muted" scope="row">Nom</th>
                                            <td class="text-16 text-success font-weight-700">
                                                {{ $commande->entreprise->nom }}

                                            </td>
                                            <th class="text-16 text-muted" scope="row">Contact&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                            <td class="text-16 text-success font-weight-700">
                                                +225 {{ $commande->entreprise->contact }}
                                            </td>                                           
                                        </tr>
                
                                    </tbody>
                                </table>
                                @else
                                    
                                @endif
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
                                <p class="text-muted mt-2 mb-0">Produit(s)</p>
                                <p class="text-primary text-24 line-height-1 mb-2">{{ $commande->products()->wherePivot('status',1)->count() }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 col-md-6 col-sm-6">
                    <div class="card mb-4">
                        <div class="card-body">
                            <h6 class="mb-2 text-muted">Progression</h6>
                            @if ($commande->status == 0)
                            <p class="mb-1 text-22 font-weight-light">35%</p>
                            <div class="progress mb-1" style="height: 4px">
                                <div class="progress-bar bg-primary" style="width: 35%" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="35"></div>
                            </div><small class="text-muted">Attente validation</small>
                            @elseif($commande->status == 1)
                            <p class="mb-1 text-22 font-weight-light">50%</p>
                            <div class="progress mb-1" style="height: 4px">
                                <div class="progress-bar bg-warning" style="width: 50%" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="50"></div>
                            </div>
                            <small class="text-muted">
                                                    @if (Auth::user()->entreprise->id == $commande->id_entreprise)
                                                        Envoyée au fournisseur
                                                    @elseif(Auth::user()->entreprise->id == $commande->id_fournisseur)
                                                        Attente de validation
                                                    @endif
                            </small>
                            @elseif($commande->status == 7)
                            <p class="mb-1 text-22 font-weight-light">70%</p>
                            <div class="progress mb-1" style="height: 4px">
                                <div class="progress-bar bg-primary" style="width: 70%" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="70"></div>
                            </div><small class="text-muted">
                               
                                @if (Auth::user()->entreprise->id == $commande->id_entreprise)
                                Validée par le fournisseur
                                @elseif(Auth::user()->entreprise->id == $commande->id_fournisseur)
                                    Validée
                                @endif
                        </small>
                            @elseif($commande->status == 2)
                            <p class="mb-1 text-22 font-weight-light">80%</p>
                            <div class="progress mb-1" style="height: 4px">
                                <div class="progress-bar bg-success" style="width: 80%" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="80"></div>
                            </div>
                                                @if (Auth::user()->entreprise->id == $commande->id_entreprise)
                                                <small class="text-muted">Attente de livraison</small>
                                                @elseif(Auth::user()->entreprise->id == $commande->id_fournisseur)
                                                    <small class="text-muted">Livraison en cours</small>
                                                @endif
                            @elseif($commande->status == 3)
                                <p class="mb-1 text-22 font-weight-light">100%</p>
                                <div class="progress mb-1" style="height: 4px">
                                    <div class="progress-bar bg-success" style="width: 100%" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                </div><small class="text-muted">Livrée</small>

                            @elseif($commande->status == 4)
                            <p class="mb-1 text-22 font-weight-light">0%</p>
                            <div class="progress mb-1" style="height: 4px">
                                <div class="progress-bar bg-danger" style="width: 0%" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="0"></div>
                            </div><small class="text-muted">Rejetée</small>

                            @elseif($commande->status == 8)
                            <p class="mb-1 text-22 font-weight-light">0%</p>
                            <div class="progress mb-1" style="height: 4px">
                                <div class="progress-bar bg-danger" style="width: 0%" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="0"></div>
                            </div><small class="text-muted">
                                
                                @if (Auth::user()->entreprise->id == $commande->id_entreprise)
                                Rejetée par fournisseur
                                @elseif(Auth::user()->entreprise->id == $commande->id_fournisseur)
                                Rejetée
                                @endif
                            </small>            
                            @endif
                            
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 col-md-6 col-sm-6">
                    <div class="card mb-4">
                        <div class="card-body">
                            <h6 class="mb-3">Statut livraison</h6>
                            @if ($commande->status == 3)
                            <p class="text-20 text-success line-height-1 mb-3"><i class="i-Arrow-Down-in-Circle"></i> Livrée</p><small class="text-muted"></small>
                            @else
                            <p class="text-20 text-danger line-height-1 mb-3"><i class="i-Arrow-Down-in-Circle"></i> Non livrée</p><small class="text-muted"></small>
                            @endif
                            
                        </div>
                    </div>
                </div>
            </div>
           
        </div>
    </div>
    <div class="row mt-5">
        <div class="col-lg-9">
            <div class="card text-left">
                <div class="card-header text-right bg-transparent">
                    @if ($commande->status == 0)
                    <button class="btn btn-outline-success m-1" type="button" data-toggle="modal" data-target="#verifyModalContent{{ $commande->id }}" data-whatever="@fat">Ajouter un produit</button> 
                    @endif
                    
                </div>
                <div class="modal fade" id="verifyModalContent{{ $commande->id }}" tabindex="-1" role="dialog" aria-labelledby="verifyModalContent{{ $commande->id }}" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="verifyModalContent{{ $commande->id }}_title">Ajout d'un produit au bon de commande</h5>
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
                                            @if ($commande->fournisseur->id == 1 || $commande->fournisseur->id == 2)
                                                @forelse (Product::where(['status'=> 1, 'id_product_category' => $commande->fournisseur->id])->orderBy('lib', 'asc')->get() as $data)
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
                                        <label class="col-form-label" for="qte">Quantité</label>
                                        <input class="form-control" value="{{ old('qte') }}" name="qte" id="qte" type="number" placeholder="Ex: 150"/>
                                    </div>
                                    <div class="form-group ">
                                        <input class="form-control" value="{{ $commande->id }}" name="bon_commande_id" id="bon_commande_id" type="text" hidden/>
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
                                    <th>Quantité</th>
                                    {{-- <th>Seuil</th>
                                    <th>Stock virtuel</th>
                                    <th>Statut</th> --}}
                                    @if ($commande->status == 0)
                                    <th>Action</th>
                                    @endif
                                    
                                </tr>
                            </thead>
                            <tbody>
                                <?php $valider = true ?>
                                
                                @forelse ($commande->products as $data)
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
                                        ->where('variations.id_entreprise', '=', Auth::user()->entreprise->id)
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
                                        ->where('variations.id_entreprise', '=', Auth::user()->entreprise->id)
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
                                    {{-- Stock virtuelle {{ dd( $qtecmde) }}--}}
                                    
                                    
                                    
                                    <td>{{ $data->ref }}</td>
                                    <td>{{ $data->lib }}</td>
                                    <td>{{ $data->pivot->qte }}</td>
                                    {{--  
                                    <td>{{ $data->stockalert }}</td>
                                    <td>{{ $stock_virtuel }}</td>
                                    <td>
                                        @if ($stock_virtuel < $data->stockalert)
                                        <?php $valider = false ?>
                                        <a class="badge badge-danger m-2 p-2" href="#">rupture</a>
                                        @else
                                        <a class="badge badge-success m-2 p-2" href="#">Disponible</a>
                                        @endif  
                                    </td>--}}
                                    @if ($commande->status == 0)
                                    <td><button class="btn btn-outline-success m-1" type="button" data-toggle="modal" data-target="#updateModalContent{{ $data->id }}" data-whatever="@fat">Modifier</button><a href="{{ route('bon_commande_fournisseur.delete_Product',['bonCommande'=>$commande->id,'product'=>$data->id]) }}"><button class="btn btn-outline-danger m-1" type="button" data-whatever="@fat">supprimer</button></a></td>
                                    @endif
                                    
                                </tr>
                                <div class="modal fade" id="updateModalContent{{ $data->id }}" tabindex="-1" role="dialog" aria-labelledby="updateModalContent{{ $data->id }}" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="updateModalContent{{ $data->id }}_title">Modifier la quantité commandé</h5>
                                                <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                            </div>
                                            <div class="modal-body">
                                                <form method="put" action="{{ route('bon_commande_fournisseur.update_Product',['bonCommande'=>$commande->id,'product'=>$data->id])}}">
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
                                                        <label class="col-form-label" for="qte">Quantité</label>
                                                        <input class="form-control" value="{{ $data->pivot->qte }}" name="qte" id="qte" type="number" placeholder="Ex: 150"/>
                                                    </div>
                                                    <div class="form-group ">
                                                        <input class="form-control" value="{{ $commande->id }}" name="commande_id" id="commande_id" type="text" hidden/>
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
                            <div class="ul-widget4__item">
                                <div class="ul-widget4__pic-icon"><i class="i-Eye text-primary"></i></div><a class="ul-widget4__title" href="{{ route('commande_fournisseur.view',['id'=> $commande->id]) }}">Voir bon de commande</a>
                            </div>
                            @if ($commande->status == 0)
                                
                               
                                @if (Auth::user()->entreprise->id == $commande->id_entreprise)
                                    <div class="ul-widget4__item">
                                        <div class="ul-widget4__pic-icon"><i class="i-Yes text-success"></i></div><a class="ul-widget4__title" href="{{ route('commande_fournisseur.valider',['slug'=> $commande->slug]) }}">Valider commande</a>
                                    </div>                            
                                    <div class="ul-widget4__item">
                                        <div class="ul-widget4__pic-icon"><i class="i-Close text-danger"></i></div><a class="ul-widget4__title" href="{{ route('commande_fournisseur.rejeter',['slug'=> $commande->slug]) }}">Rejeter la commande</a>
                                    </div>
                                        <div class="ul-widget4__item">
                                            <div class="ul-widget4__pic-icon"><i class="i-Close text-danger"></i></div><a class="ul-widget4__title" href="{{ route('commande_fournisseur.destroy',['id'=> $commande->id]) }}">Supprimer bon de commande</a>
                                    </div>
                                @endif
                                
                            @endif
                            @if ($commande->status == 1)
                                @if (Auth::user()->entreprise->id == $commande->id_fournisseur)
                                    <div class="ul-widget4__item">
                                        <div class="ul-widget4__pic-icon"><i class="i-Yes text-success"></i></div><a class="ul-widget4__title" href="{{ route('commande_fournisseur.accept',['slug'=> $commande->slug]) }}">Accepter la commande</a>
                                    </div>
                                    <div class="ul-widget4__item">
                                        <div class="ul-widget4__pic-icon"><i class="i-Close text-danger"></i></div><a class="ul-widget4__title" href="{{ route('commande_fournisseur.refuse',['slug'=> $commande->slug]) }}">Rejeter la commande</a>
                                    </div> 
                                @endif
                            @endif
                            @if ($commande->status == 7)
                                @if (Auth::user()->entreprise->id == $commande->id_fournisseur)
                                    <div class="ul-widget4__item">
                                        <div class="ul-widget4__pic-icon"><i class="i-Car text-warning"></i></div><a class="ul-widget4__title" href="#" type="button" data-toggle="modal" onclick="event.preventDefault();" data-target="#livraisonModalContent{{ $commande->id }}" data-whatever="@fat">Créer bon de livraison</a>
                                    </div> 
                                @endif
                            @endif
                            @if ($commande->status == 2)
                                @if (Auth::user()->entreprise->id == $commande->id_entreprise)
                                    <div class="ul-widget4__item">
                                        <div class="ul-widget4__pic-icon"><i class="i-Car text-success"></i></div><a class="ul-widget4__title" href="{{ route('commande_fournisseur.livrer',['slug'=> $commande->slug]) }}">Classer comme livrer</a>
                                    </div> 
                                @endif
                                @if (Auth::user()->entreprise->id == $commande->id_fournisseur)
                                    <div class="ul-widget4__item">
                                        <div class="ul-widget4__pic-icon"><i class="i-Eye text-warning"></i></div><a class="ul-widget4__title" href="{{ route('commande_fournisseur.viewlivraison',['id'=> $commande->id]) }}">Voir bon de livraison</a>
                                    </div> 
                                @endif   
                            @endif
                            @if ($commande->status == 3)
                               
                                    <div class="ul-widget4__item">
                                        <div class="ul-widget4__pic-icon"><i class="i-Eye text-warning"></i></div><a class="ul-widget4__title" href="{{ route('commande_fournisseur.viewlivraison',['id'=> $commande->id]) }}">Voir bon de livraison</a>
                                    </div> 
                             
                            @endif
                             <div class="modal fade" id="livraisonModalContent{{ $commande->id }}" tabindex="-1" role="dialog" aria-labelledby="livraisonModalContent{{ $commande->id }}" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="livraisonModalContent{{ $commande->id }}_title">Créer un bon de livraison</h5>
                                            <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                        </div>
                                        <div class="modal-body">
                                            <form method="post" action="{{ route('commande_fournisseur.create_bon_livraison')}}">
                                                @csrf
                                                @method('POST')
                                                <div class="form-group ">
                                                    <label class="col-form-label" for="nom_livreur">Nom du livreur</label>
                                                    <select name="id_livreur" id="id_livreur" class="form-control" required>
                                                        <option value=""  selected>-- Sélectionner --</option>
                                                        @forelse (Livreur::where('status', 1)->orderBy('nom', 'asc')->get() as $data)
                                                            <option value="{{ $data->id }}" @if (old('id_livreur')== '{{ $data->id }}') selected="selected" @endif>{{ $data->nom }}</option>
                                                        @empty
                                                            
                                                        @endforelse
                                                    </select>
                                                </div>
                                                {{-- <div class="form-group ">
                                                    <label class="col-form-label" for="numero_vehicule">Numéro du véhicule</label>
                                                    <input class="form-control"  name="numero_vehicule" id="numero_vehicule" type="text" placeholder="Ex: 9857JN01"/>
                                                </div> --}}
                                                <div class="form-group ">
                                                    <input class="form-control" value="{{ $commande->id }}" name="commande_id" id="commande_id" type="text" hidden/>
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