@php
    $entrepots = $entrepots ?? null;
    $entrepot = $entrepot ?? null;
    $products = $products ?? null;
    $product = $product ?? null;
    $id = $entrepot ? $entrepot->id : '';
@endphp
<div class="modal fade" id="add_variation{{ $product->id }}{{ $id }}transfert" tabindex="-1" role="dialog" aria-labelledby="add_variation{{ $product->id }}" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="add_variation{{ $product->id }}_title">Effectuer un transfert de stock</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body">
                <form method="post" action="{{ route('stock.variations.store') }}" enctype="multipart/form-data">
                    @csrf
                    @method('POST')

                    <input type="hidden" name="typemouv" value="trans">
                    
                    <div class="form-group ">
                        <label class="col-form-label" for="id_entrepot">Entrepôt source:</label>
                        @if ($entrepot)
                            <input type="hidden" name="id_entrepot_source" value="{{ $entrepot->id }}">
                            <input type="text" class="form-control" value="{{ $entrepot->name }}" readonly disabled>
                        @else
                            <select name="id_entrepot_source" class="form-control" id="id_entrepot_source" required>
                                {{-- @forelse (Entreprise::where('status', 1)->orderBy('nom', 'asc')->get() as $data) --}}
                                @forelse ($entrepots as $data)
                                    <option value="{{ $data->id }}">{{ $data->name }}</option>
                                @empty
                                    
                                @endforelse
                            </select>
                        @endif
                    </div>
                    <div class="form-group ">
                        <label class="col-form-label" for="id_entrepot_destination">Entrepôt destination:</label>
                        <select name="id_entrepot_destination" class="form-control" id="id_entrepot_destination" required>
                            {{-- @forelse (Entreprise::where('status', 1)->orderBy('nom', 'asc')->get() as $data) --}}
                            @forelse ($entrepot->voisins() as $data)
                                <option value="{{ $data->id }}">{{ $data->name }}</option>
                            @empty
                                
                            @endforelse
                        </select>
                    </div>
                    <div class="form-group ">
                        <label class="col-form-label" for="id_product">Produit:</label>
                        @if ($product)
                            <input type="hidden" name="id_products" value="{{ $product->id }}">
                            <input type="text" class="form-control" value="{{ $product->name }}" readonly disabled>
                        @else
                            <select name="product" class="form-control" id="id_products" required>
                                {{-- @forelse (Entreprise::where('status', 1)->orderBy('nom', 'asc')->get() as $data) --}}
                                @forelse (App\Models\Product::all() as $data)
                                    <option value="{{ $data->id }}">{{ $data->lib }}</option>
                                @empty
                                    
                                @endforelse
                            </select>
                        @endif
                    </div>
                    <div class="form-group ">
                        <label class="col-form-label" for="qte">Quantité à Transférer:</label>
                        <input class="form-control"  id="qte" type="number" min="0" name="qte" required/>
                    </div>
                    <div class="form-group ">
                        <label class="col-form-label" for="datemouv">Date transfert:</label>
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