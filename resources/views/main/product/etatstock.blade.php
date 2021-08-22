@extends('main.layout.main')

@section('stylesheets')

@endsection

@section('menuTitle')
Produit
@endsection

@section('pageTitle')
Etat du stock {{ $entreprise->nom }}
@endsection

@section('content')
<div class="row mb-4">
    <div class="col-md-12 mb-4">
        <div class="card text-left">
            
            <div class="card-body">
                
                {{--  <a href="{{ route('stock.product.create') }}">--}}{{-- <button class="btn btn-lg btn-primary" data-toggle="modal" data-target="#addvariation" data-whatever="@fat" style="float: right" data-style="expand-right"><span class="ladda-label">Ajouter un mouvement</span></button> --}} {{--</a>--}}
                <div class="modal fade" id="addvariation" tabindex="-1" role="dialog" aria-labelledby="addvariation" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="addvariation_title">Ajouter un nouveau mouvement</h5>
                                <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                            </div>
                            <div class="modal-body">
                                <form method="post" action="{{ route('stock.variation.store')}}">
                                    @csrf
                                    @method('POST')
                                    <div class="form-group ">
                                        <label class="col-form-label" for="slug_product_category">Nom de l'entreprise:</label>
                                        <select name="entreprise" class="form-control" required>
                                            @forelse (Entreprise::where('status', 1)->orderBy('nom', 'asc')->get() as $data)
                                                <option value="{{ $data->slug }}">{{ $data->nom }}</option>
                                            @empty
                                                
                                            @endforelse
                                        </select>
                                    </div>
                                    <div class="form-group ">
                                        <label class="col-form-label" for="slug_product_category">Nature du mouvement:</label>
                                        <select name="slug_product_category" class="form-control" required>
                                                <option value="0" >Entrée</option>
                                                <option value="1" >Sortie</option>
                                        </select>
                                    </div>
                                    <div class="form-group ">
                                        <label class="col-form-label" for="slug_product_category">Nom du produit:</label>
                                        <select name="product" class="form-control" required>
                                            @forelse (Product::where('status', 1)->orderBy('lib', 'asc')->get() as $data)
                                                <option value="{{ $data->slug }}">{{ $data->lib }}</option>
                                            @empty
                                                
                                            @endforelse
                                        </select>
                                    </div>
                                    <div class="form-group ">
                                        <label class="col-form-label" for="slug_product_category">Nom du fournisseur:</label>
                                        <select name="fournisseur" class="form-control" required>
                                            @forelse (Fournisseur::where('status', 1)->orderBy('nom', 'asc')->get() as $data)
                                                <option value="{{ $data->slug }}">{{ $data->nom }}</option>
                                            @empty
                                                
                                            @endforelse
                                        </select>
                                    </div>
                                    <div class="form-group ">
                                        <label class="col-form-label" for="slug_product_category">Nom du client:</label>
                                        <select name="client" class="form-control" required>
                                            @forelse (Client::where('status', 1)->orderBy('nom', 'asc')->get() as $data)
                                                <option value="{{ $data->slug }}" >{{ $data->nom }} {{ $data->pnom }}</option>
                                            @empty
                                                
                                            @endforelse
                                        </select>
                                    </div>
                                    <div class="form-group ">
                                        <label class="col-form-label" for="price"> Date du mouvement:</label>
                                        <input class="form-control" id="price" type="text" data-inputmask='"mask": "99/99/9999"' data-mask name="price" required/>
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
                                @forelse ($products as $data)
                                <tr>
                                    @php                                    
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
                                <?php $stock_virtuel = $data->total_stock - $total_qte_cmde; ?>
                                @if ($entreprise->id != 1)
                                    <?php $stock_virtuel = $data->total_stock; ?>
                                @endif
                                    <td>{{ $data->ref }}</td>
                                    <td>{{ $data->lib }}</td>
                                    <td>{{ $data->category }}</td>
                                    <td>
                                        
                                        @if ($data->total_stock < $data->stockalert)
                                        <strong style="color: red">{{ $data->stockalert }}</strong>
                                        @else
                                        <strong style="color: green">{{ $data->stockalert }}</strong>
                                        @endif
                                    </td>
                                    <td>{{ $data->total_stock }}</td>
                                    <td>{{ $stock_virtuel }}</td>
                                    <td>
                                        @if ($stock_virtuel < $data->stockalert)
                                        <a class="badge badge-danger text-white m-2 p-2">Rupture </a>
                                        @else
                                        <a class="badge badge-success text-white m-2 p-2">Disponible</a>
                                        @endif
                                     </td>
                                    <td><button class="btn btn-outline-success m-1" type="button" data-toggle="modal" data-target="#verifyModalContent{{ $data->id }}" data-whatever="@fat">Modifier</button><a href="{{ route('stock.stock_story.index',['entreprise'=>$entreprise->slug, 'slug'=> $data->slug]) }}"><button class="btn btn-outline-warning m-1" type="button">Historique</button></a>{{-- <a href="{{ route('stock.product.destroy',['slug'=>$data->id]) }}"><button class="btn btn-outline-danger m-1" type="button">Supprimer</button></a> --}}</td>
                                </tr>
                                <div class="modal fade" id="verifyModalContent{{ $data->id }}" tabindex="-1" role="dialog" aria-labelledby="verifyModalContent{{ $data->id }}" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="verifyModalContent{{ $data->id }}_title">Modification du produit {{ $data->lib }}</h5>
                                                <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                            </div>
                                            <div class="modal-body">
                                                <form method="post" action="{{ route('stock.variation.store', ['product'=>$data->id, 'entreprise'=>$entreprise->id])}}">
                                                    @csrf
                                                    @method('POST')
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
                            @empty
                                
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
        </div>
    </div>
</div>
@endsection

@section('javascripts')
<script>
    $('#datemouv').on('focus', function() {
        $('.datepicker').pickadate({
            monthsFull: ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'],
            weekdaysShort: ['Dim', 'Lun', 'Mar', 'Mer', 'Jeu', 'Ven', 'Sam'],
            today: 'aujourd\'hui',
            clear: 'effacer',
            format: 'dd-mm-yyyy',
            formatSubmit: 'dd-mm-yyyy',
            close: 'fermer',
            selectYears: true,
            selectMonths: true,
            labelMonthNext: 'Mois suivant',
            labelMonthPrev: 'Mois précédent',
            labelMonthSelect: 'Selectionner un mois',
            labelYearSelect: 'Selectionner une année',
            min: Date.now(),
            disable: [
                1, 7
            ]
        });
    });
</script>
@endsection