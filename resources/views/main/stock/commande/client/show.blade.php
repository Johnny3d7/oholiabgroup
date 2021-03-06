@extends('main.stock.partials.main')

@section('stylesheets')

@endsection

@section('menuTitle')
Commande
@endsection

@section('pageTitle')
Commande
@endsection

@section('content')
<!-- section 1-->
<section class="ul-widget-stat-s1">
    <div class="row">    
        <div class="col-lg-9">
            <div class="card">
                <div class="card-body">
                    <div class="card-title">Détails commande</div><span class="text-muted"></span>
                    <div class="row">
                        <div class="col-lg-12 mt-1">
                            <div class="ul-product-cart__invoice">
                                <div class="card-title">
                                    <h3 class="heading text-primary"> COMMANDE</h3>
                                    @if (strpos(strtolower($commande->products->first()->category->lib), 'obp'))
                                    <img class="logo" style="height: 50px; width:auto; float:right !important; margin-top:-40px !important;" src="{{ url('images/logoobp.png') }}" alt="">
                                    @elseif(strpos(strtolower($commande->products->first()->category->lib), 'ak'))
                                    <img class="logo" style="height: 120px; width:auto; float:right !important; margin-top:-80px !important;" src="{{ url('images/logoakebie.png') }}" alt="">
                                    @endif                                    
                                </div>
                                <div>    
                                </div>
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <th class="text-16 text-muted" scope="row">N° commande</th>
                                            <td class="text-16 text-success font-weight-700">
                                                {{ $commande->num_cmd }}

                                            </td>
                                            <th class="text-16 text-muted" scope="row">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nature commande</th>
                                            <td class="text-16 text-success font-weight-700">
                                                {{ $commande->products->first()->category->lib }}
                                            </td>                                                 
                                        </tr>
                                        
                                        <tr>
                                            <th class="text-16 text-muted" scope="row">Canal d'information</th>
                                            <td class="text-16 text-success font-weight-700">
                                                {{ $commande->canal_reception }}
                                            </td>   
                                            <th class="text-16" scope="row">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Date de réception</th>
                                            <td class="text-16 text-success font-weight-700">
                                                {{ ucwords((new Carbon\Carbon($commande->created_at))->locale('fr')->isoFormat('DD/MM/YYYY')) }}

                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <div class="card-title">
                                    <h3 class="heading text-primary">CLIENT</h3>
                                </div>
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <th class="text-16 text-muted" scope="row">Nom & Prénom(s)</th>
                                            <td class="text-16 text-success font-weight-700">
                                                {{ $commande->client->nom }}

                                            </td>
                                            <th class="text-16 text-muted" scope="row">Contact&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                            <td class="text-16 text-success font-weight-700">
                                                +225 {{ $commande->client->contact }}
                                            </td>                                           
                                        </tr>
                                        
                                        <tr>
                                            <th class="text-16 text-muted" scope="row">Email</th>
                                            <td class="text-16 text-success font-weight-700">
                                                {{ $commande->client->email }}
                                            </td>   
                                            <th class="text-16" scope="row">Type client</th>
                                            <td class="text-16 text-success font-weight-700">
                                                @if ($commande->client->typeClient)
                                                {{ $commande->client->typeClient->lib }}
                                                @else
                                                    
                                                @endif
                                              

                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <div class="card-title">
                                    <h3 class="heading text-primary">LIVRAISON</h3>
                                </div>
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <th class="text-16 text-muted" scope="row">Lieu de livraison</th>
                                            <td class="text-16 text-success font-weight-700">
                                                {{ $commande->lieu_livraison }}

                                            </td>
                                            <th class="text-16 text-muted" scope="row">Date de livraison</th>
                                            <td class="text-16 text-success font-weight-700">
                                                {{ $commande->date_livraison }}
                                            </td>                                           
                                        </tr>
                                        
                                        <tr>
                                            <th class="text-16 text-muted" scope="row">Statut</th>
                                            
                                                @if ($commande->status == 0)
                                                <td class="text-16 text-primary font-weight-700">
                                                    Vérification stock
                                                </td> 
                                                @elseif($commande->status == 1 )
                                                <td class="text-16 text-warning font-weight-700">
                                                    Attente de livraison
                                                </td>
                                                @elseif($commande->status == 2)
                                                <td class="text-16 text-danger font-weight-700">
                                                    Rejetée
                                                </td>
                                                @elseif($commande->status == 3)
                                                <td class="text-16 text-danger font-weight-700">
                                                    Annulée
                                                </td>
                                                @elseif($commande->status == 5)
                                                <td class="text-16 text-success font-weight-700">
                                                    Livrée
                                                </td>
                                                @endif
                                              
                                            <th class="text-16 text-muted" scope="row"></th>
                                            <td class="text-16 text-success font-weight-700">
                                                

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
                                <p class="text-primary text-24 line-height-1 mb-2">{{ $commande->products()->wherePivot('status',1)->count() }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 col-md-6 col-sm-6">
                    <div class="card card-icon-bg card-icon-bg-primary o-hidden mb-4">
                        <div class="card-body text-center"><i class="i-Money-2"></i>
                            <div class="content">
                                <p class="text-muted mt-2 mb-0">Montant</p>
                                
                                <p class="text-primary text-16 line-height-1 mb-2">
                                            <?php $mttc = 0; ?>
                                           
                                            @foreach ($commande->products as $data) 
                                            <?php $mttc += $data->pivot->qte * $data->pivot->prix; ?>
                                            @endforeach
                                            {{ number_format($mttc, 0, '', '.') }}&nbsp;Fcfa
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 col-md-6 col-sm-6">
                    <div class="card mb-4">
                        <div class="card-body">
                            <h6 class="mb-2 text-muted">Progression</h6>
                            @if ($commande->status == 0)
                            <p class="mb-1 text-22 font-weight-light">30%</p>
                            <div class="progress mb-1" style="height: 4px">
                                <div class="progress-bar bg-primary" style="width: 30%" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                            </div><small class="text-muted">vérification stock</small>
                            @elseif($commande->status == 1)
                            <p class="mb-1 text-22 font-weight-light">70%</p>
                            <div class="progress mb-1" style="height: 4px">
                                <div class="progress-bar bg-warning" style="width: 70%" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                            </div><small class="text-muted">Attente de livraison</small>
                            @elseif($commande->status == 2)
                            <p class="mb-1 text-22 font-weight-light">0%</p>
                            <div class="progress mb-1" style="height: 4px">
                                <div class="progress-bar bg-danger" style="width: 0%" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                            </div><small class="text-muted">Rejetée</small>
                            @elseif($commande->status == 5)
                            <p class="mb-1 text-22 font-weight-light">100%</p>
                            <div class="progress mb-1" style="height: 4px">
                                <div class="progress-bar bg-success" style="width: 100%" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                            </div><small class="text-muted">Livrée</small>
                            @elseif($commande->status == 3)
                            <p class="mb-1 text-22 font-weight-light">100%</p>
                            <div class="progress mb-1" style="height: 4px">
                                <div class="progress-bar bg-danger" style="width: 100%" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                            </div><small class="text-muted">Annulée</small>
                            @endif
                            
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 col-md-6 col-sm-6">
                    <div class="card mb-4">
                        <div class="card-body">
                            <h6 class="mb-3">Statut de livraison</h6>
                            @if ($commande->status == 3)
                            <p class="text-20 text-success line-height-1 mb-3"><i class="i-Arrow-Up-in-Circle"></i>Livrée</p><small class="text-muted">
                                Livrée il y a 
                                @php
                                        $dt = Carbon::now();
                                        $date = explode(' ',$dt->diffForHumans($commande->date_livraison));
                                        @endphp
                                        <i>
                                            {{ $date[0] }} 
                                            @if ( $date[1] == 'days' || $date[1] == 'day'  )
                                                jour(s)
                                            @elseif($date[1] == 'months' || $date[1] == 'month')
                                                mois
                                            @elseif($date[1] == 'week' || $date[1] == 'weeks')
                                                semaine(s)
                                            @endif 
                                        </i>
                            </small>

                            @else
                                @php
                                $dt = Carbon::now();
                                $date = explode(' ',$dt->diffForHumans($commande->date_livraison));
                                @endphp

                                @if ($commande->date_livraison < $dt)
                                    <p class="text-20 text-danger line-height-1 mb-3"><i class="i-Arrow-Down-in-Circle"></i>Non livrée</p><small class="text-muted">
                                        Livraison dans 
                                        
                                        <i>
                                            {{ $date[0] }}  
                                            @if ( $date[1] == 'days' || $date[1] == 'day'  )
                                                jour(s)
                                            @elseif($date[1] == 'months' || $date[1] == 'month')
                                                mois
                                            @elseif($date[1] == 'week' || $date[1] == 'weeks')
                                                semaine(s)
                                            @elseif($date[1] == 'hours' || $date[1] == 'hour')
                                                heure(s)
                                            @endif 
                                        </i>
                                    </small>
                                @else
                                    <p class="text-20 text-danger line-height-1 mb-3"><i class="i-Arrow-Down-in-Circle"></i>Non livrée</p><small class="text-muted">
                                        Livraison en retard 
                                        
                                    </small>
                                @endif
                                

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
                    <button class="btn btn-outline-success m-1" type="button" data-toggle="modal" data-target="#verifyModalContent{{ $commande->id }}" data-whatever="@fat">Ajouter un produit</button> 
                </div>
                <div class="modal fade" id="verifyModalContent{{ $commande->id }}" tabindex="-1" role="dialog" aria-labelledby="verifyModalContent{{ $commande->id }}" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="verifyModalContent{{ $commande->id }}_title">Ajout d'un produit à la commande</h5>
                                <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                            </div>
                            <div class="modal-body">
                                <form method="post" action="{{ route('commande_client.add_Product')}}">
                                    @csrf
                                    @method('POST')
                                    <div class="form-group ">
                                        <label class="col-form-label" for="product">Produit</label>
                                        <select name="product"  class="form-control produit" id="product">
                                            <option value=""  selected>-- Sélectionner --</option>
                                            @forelse (Product::where(['status'=> 1, 'id_product_category' => $commande->type])->orderBy('lib', 'asc')->get() as $data)
                                                <option value="{{ $data->id }}">{{ $data->lib }}</option>
                                            @empty
                                                
                                            @endforelse
                                        </select>
                                    </div>
                                    <div class="form-group ">
                                        <label class="col-form-label" for="qte">Quantité</label>
                                        <input class="form-control" value="{{ old('qte') }}" name="qte" id="qte" type="number" placeholder="Ex: 150"/>
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
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="display table" id="ul-contact-list" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Référence</th>
                                    <th>Libellé</th>
                                    <th>prix unitaire</th>
                                    <th>Quantité</th>
                                    <th>sous-total</th>
                                    <th>Etat stock</th>
                                    <th>Action</th>
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
                                        $total_qte_cmde += $ligne->quantite  ; 
                                    ?>
                                    @endforeach
                                    {{-- Stock virtuelle --}}
                                    <?php $stock_virtuel = $product[0]->total_stock - $total_qte_cmde; ?>

                                
                                    <td>{{ $data->ref }}</td>
                                    <td>{{ $data->lib }}</td>
                                    <td>{{ number_format($data->pivot->prix, 0, '', '.') }} Fcfa</td>
                                    <td>{{ $data->ref }}</td>
                                    <td>{{ number_format($data->pivot->qte * $data->pivot->prix, 0, '', '.')  }} Fcfa</td>
                                    <td>
                                        @if ($stock_virtuel < 0)
                                        <?php $valider = false ?>
                                        <a class="badge badge-danger m-2 p-2" href="#">Indisponible</a>
                                        @else
                                        <a class="badge badge-success m-2 p-2" href="#">Disponible</a>
                                        @endif  
                                    </td>
                                    <td><button class="btn btn-outline-success btn-icon m-1" type="button" data-toggle="modal" data-target="#updateModalContent{{ $data->id }}" data-whatever="@fat"><span class="ul-btn__icon"><i class="i-Edit"></i></span></button><a href="{{ route('commande_client.delete_Product',['commande'=>$commande->id,'product'=>$data->id]) }}"><button class="btn btn-outline-danger btn-icon m-1" type="button" data-whatever="@fat"><span class="ul-btn__icon"><i class="i-Close"></i></span></button></a></td>
                                </tr>
                                <div class="modal fade" id="updateModalContent{{ $data->id }}" tabindex="-1" role="dialog" aria-labelledby="updateModalContent{{ $data->id }}" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="updateModalContent{{ $data->id }}_title">Modifié la quantité du produit</h5>
                                                <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                            </div>
                                            <div class="modal-body">
                                                <form method="put" action="{{ route('commande_client.update_Product',['commande'=>$commande->id,'product'=>$data->id])}}">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="form-group ">
                                                        <label class="col-form-label" for="product">Produit</label>
                                                        <select name="product" disabled  class="form-control produit" id="product">
                                                            <option value=""  selected>-- Sélectionner --</option>
                                                            @forelse (Product::where(['status'=> 1, 'id_product_category' => $commande->type])->orderBy('lib', 'asc')->get() as $prod)
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
                            @if ($commande->status == 0)
                                @if ($valider == true)
                                        <div class="ul-widget4__item">
                                            <div class="ul-widget4__pic-icon"><i class="i-Yes text-success"></i></div><a class="ul-widget4__title" href="{{ route('commande_client.valider',['slug'=> $commande->slug]) }}">Valider la commande</a>
                                        </div>                            
                                @elseif($valider == false)
                                        <div class="ul-widget4__item">
                                            <div class="ul-widget4__pic-icon"><i class="i-Close text-danger"></i></div><a class="ul-widget4__title" href="{{ route('commande_client.rejeter',['slug'=> $commande->slug]) }}">Rejeter la commande</a>
                                        </div>
                                @endif
                                <div class="ul-widget4__item">
                                    <div class="ul-widget4__pic-icon"><i class="i-Close text-danger"></i></div><a class="ul-widget4__title" href="{{ route('commande_client.annuler',['slug'=> $commande->slug]) }}">Annuler la commande</a>
                                </div>
                                <div class="ul-widget4__item">
                                    <div class="ul-widget4__pic-icon"><i class="i-Close text-danger"></i></div><a class="ul-widget4__title" href="{{ route('commande_client.destroy',['slug'=> $commande->slug]) }}">Supprimer la commande</a>
                                </div>
                            @endif
                            
                            @if ($commande->status == 1)
                                @if ($commande->create_bonlivraison == 1)
                                    <div class="ul-widget4__item">
                                        <div class="ul-widget4__pic-icon"><i class="i-Folder-Organizing text-success"></i></div><a class="ul-widget4__title" href="{{ route('commande_client.livrer',['slug'=> $commande->slug]) }}">Classez livrée</a>
                                    </div>
                                @endif
                                @if ($commande->create_facture == 0)
                                <div class="ul-widget4__item">
                                    <div class="ul-widget4__pic-icon"><i class="i-Billing text-info"></i></div><a class="ul-widget4__title" href="#">Crée facture</a>
                                </div>
                                @endif
                                @if ($commande->create_bonlivraison == 0)
                                <div class="ul-widget4__item">
                                    {{-- <div class="ul-widget4__pic-icon"><i class="i-Car text-info"></i></div><a class="ul-widget4__title" href="#" type="button" data-toggle="modal" onclick="event.preventDefault();" data-target="#livraisonModalContent{{ $commande->id }}" data-whatever="@fat">Voir bon de livraison</a> --}}

                                    <div class="ul-widget4__pic-icon"><i class="i-Car text-info"></i></div><a class="ul-widget4__title" href="{{ route('viewcommande',['slug'=>$commande->slug]) }}" type="button">Voir bon de livraison</a>
                                </div>
                                @else
                                <div class="ul-widget4__item">
                                    {{-- <div class="ul-widget4__pic-icon"><i class="i-Eye text-info"></i></div><a class="ul-widget4__title" href="#">Visonner le bon de livraison</a> --}}
                                </div>
                                @endif
                                </div><div class="ul-widget4__item">
                                    <div class="ul-widget4__pic-icon"><i class="i-Close text-danger"></i></div><a class="ul-widget4__title" href="{{ route('commande_client.annuler',['slug'=> $commande->slug]) }}">Annuler la commande</a>
                                </div>
                                <div class="ul-widget4__item">
                                    <div class="ul-widget4__pic-icon"><i class="i-Close text-danger"></i></div><a class="ul-widget4__title" href="{{ route('commande_client.destroy',['slug'=> $commande->slug]) }}">Supprimer la commande</a>
                                </div>
                            @endif

                            @if ($commande->status == 2)
                                </div><div class="ul-widget4__item">
                                    <div class="ul-widget4__pic-icon"><i class="i-Close text-danger"></i></div><a class="ul-widget4__title" href="{{ route('commande_client.annuler',['slug'=> $commande->slug]) }}">Annuler la commande</a>
                                </div>
                                <div class="ul-widget4__item">
                                    <div class="ul-widget4__pic-icon"><i class="i-Close text-danger"></i></div><a class="ul-widget4__title" href="{{ route('commande_client.destroy',['slug'=> $commande->slug]) }}">Supprimer la commande</a>
                                </div>
                                <div class="ul-widget4__item">
                                    <div class="ul-widget4__pic-icon"><i class="i-Refresh text-warning"></i></div><a class="ul-widget4__title" href="{{ route('commande_client.restaurer',['slug'=> $commande->slug]) }}">Restaurer la commande</a>
                                </div>
                            @endif

                            @if ($commande->status == 3)
                                <div class="ul-widget4__item">
                                    <div class="ul-widget4__pic-icon"><i class="i-Close text-danger"></i></div><a class="ul-widget4__title" href="{{ route('commande_client.destroy',['slug'=> $commande->slug]) }}">Supprimer la commande</a>
                                </div>
                                <div class="ul-widget4__item">
                                    <div class="ul-widget4__pic-icon"><i class="i-Refresh text-warning"></i></div><a class="ul-widget4__title" href="{{ route('commande_client.restaurer',['slug'=> $commande->slug]) }}">Restaurer la commande</a>
                                </div>
                            @endif

                            @if ($commande->status == 4)
                                <div class="ul-widget4__item">
                                    <div class="ul-widget4__pic-icon"><i class="i-Refresh text-warning"></i></div><a class="ul-widget4__title" href="{{ route('commande_client.restaurer',['slug'=> $commande->slug]) }}">Restaurer la commande</a>
                                </div>
                            @endif

                            @if ($commande->status == 5)
                                <div class="ul-widget4__item">
                                    <div class="ul-widget4__pic-icon"><i class="i-Billing text-info"></i></div><a class="ul-widget4__title" href="#">Cree facture</a>
                                </div>
                                @if ($commande->create_bonlivraison == 0)
                                <div class="ul-widget4__item">
                                    {{-- <div class="ul-widget4__pic-icon"><i class="i-Car text-info"></i></div><a class="ul-widget4__title" type="button" href="#" data-toggle="modal" onclick="event.preventDefault();" data-target="#livraisonModalContent{{ $commande->id }}" data-whatever="@fat">Voir bon de livraison</a> --}}
                                    <div class="ul-widget4__pic-icon"><i class="i-Car text-info"></i></div><a class="ul-widget4__title" href="{{ route('viewcommande',['slug'=>$commande->slug]) }}" type="button">Voir bon de livraison</a>
                                </div>
                                @else
                                <div class="ul-widget4__item">
                                    {{-- <div class="ul-widget4__pic-icon"><i class="i-Eye text-info"></i></div><a class="ul-widget4__title" href="#">Visonner le bon de livraison</a> --}}
                                </div>
                                @endif
                            @endif
                            <div class="modal fade" id="livraisonModalContent{{ $commande->id }}" tabindex="-1" role="dialog" aria-labelledby="livraisonModalContent{{ $commande->id }}" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                             <h5 class="modal-title" id="livraisonModalContent{{ $commande->id }}_title">Voir le bon de livraison</h5> 
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
     });
 </script>
@endsection