<div class="modal fade" id="edit_{{ $ligne->uuid }}_modal" tabindex="-1" role="dialog" aria-labelledby="edit_{{ $ligne->uuid }}_modal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="">Edition de ligne {{{ $ligne->article }}}</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body">
                <form method="post" action="{{ route('achats.besoins.lignes.update', $ligne) }}">
                    @csrf
                    @method('PUT')

                    {{-- <div class="form-group "> --}}
                        <label class="my-1" for="article">Libéllé Article</label>
                        <input class="form-control" id="article" name="article" type="text" placeholder="Ex: Matériels" value="{{ $ligne->article }}" required />
                    {{-- </div> --}}
                    {{-- <div class="form-group "> --}}
                        <label class="my-1 mt-3" for="prix">Prix Unitaire</label>
                        <input type="number" min="50" step="50" class="form-control" id="prix" name="prix" type="text" placeholder="Ex: 3000" value="{{ $ligne->prix }}" required />
                    {{-- </div> --}}
                    {{-- <div class="form-group "> --}}
                        <label class="my-1 mt-3" for="quantite">Quantité</label>
                        <input type="number" min="1" step="1" class="form-control" id="quantite" name="quantite" type="text" placeholder="Ex: 1" value="{{ $ligne->quantite }}" required />
                    {{-- </div> --}}
                    {{-- <div class="form-group "> --}}
                        <label class="my-1 mt-3" for="unite">Unité</label>
                        <input type="text" class="form-control" id="unite" name="unite" type="text" placeholder="Ex: unité" value="{{ $ligne->unite }}" required />
                    {{-- </div> --}}
                    {{-- <div class="form-group "> --}}
                        <label class="my-1 mt-3" for="observations">Observations</label>
                        <textarea class="form-control" id="observations" name="observations" cols="30" rows="4">{{ $ligne->observations }}</textarea>
                    {{-- </div> --}}
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Fermer</button>
                        <button class="btn btn-primary" type="submit">Valider</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
