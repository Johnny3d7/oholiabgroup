@php
    $entrepot = $entrepot ?? null;
    $id = $entrepot ? $entrepot->id : '';
    $type = $type ?? ''
@endphp
<div class="modal fade" id="add_variation{{ $product->id }}{{ $id }}{{ $type }}" tabindex="-1" role="dialog" aria-labelledby="add_variation{{ $product->id }}" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="add_variation{{ $product->id }}_title">Effectuer {{ $type ? 'une '.$type : 'un mouvement' }} de stock</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body">
                <form method="post" action="{{ route('stock.variation.store', ['product'=>$product->id]) }}" enctype="multipart/form-data">
                    @csrf
                    @method('POST')
                    @if ($entrepot)
                        <input type="hidden" name="id_entrepot" value="{{ $entrepot->id }}">
                    @else
                        <div class="form-group ">
                            <label class="col-form-label" for="id_entrepot">Entrepôt:</label>
                            <select name="id_entrepot" class="form-control" id="id_entrepot" required>
                                {{-- @forelse (Entreprise::where('status', 1)->orderBy('nom', 'asc')->get() as $data) --}}
                                @forelse (App\Models\Entrepot::all() as $data)
                                    <option value="{{ $data->id }}">{{ $data->lib }}</option>
                                @empty
                                    
                                @endforelse
                            </select>
                        </div>
                    @endif
                    @if ($type)
                        <input type="hidden" name="typemouv" value="{{ $type == 'sortie' ? 0 : 1 }}">
                    @else
                        <div class="form-group ">
                            <label class="col-form-label" for="typemouv">Nature mouvement:</label>
                            <select name="typemouv" class="form-control" id="typemouv" required>
                                <option value="1">Entrée</option>
                                <option value="0">Sortie</option>
                            </select>
                        </div>
                    @endif
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