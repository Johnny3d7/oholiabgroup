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
                <form method="post" action="{{ route('stock.variations.store') }}" enctype="multipart/form-data">
                    @csrf
                    @method('POST')
                    <input type="hidden" name="id_products" value="{{ $product->id }}">
                    @if ($entrepot)
                        <input type="hidden" name="id_entrepots" value="{{ $entrepot->id }}">
                    @else
                        <div class="form-group ">
                            <label class="col-form-label" for="id_entrepots">Entrepôt:</label>
                            <select name="id_entrepots" class="form-control" id="id_entrepots" required>
                                {{-- @forelse (Entreprise::where('status', 1)->orderBy('nom', 'asc')->get() as $data) --}}
                                @forelse ($product->entrepots() as $entrepot)
                                    <option value="{{ $entrepot->id }}">{{ $entrepot->name }}</option>
                                @empty
                                    
                                @endforelse
                            </select>
                        </div>
                    @endif
                    @if ($type)
                        <input type="hidden" name="typemouv" value="{{ $type == 'sortie' ? 'out' : 'in' }}">
                    @else
                        <div class="form-group ">
                            <label class="col-form-label" for="typemouv">Nature mouvement:</label>
                            <select name="typemouv" class="form-control" id="typemouv" required>
                                <option value="in">Entrée</option>
                                <option value="out">Sortie</option>
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