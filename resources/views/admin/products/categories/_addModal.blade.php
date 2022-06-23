<div class="modal fade" id="add_subcategorie_{{ $categorie->uuid }}_modal" tabindex="-1" role="dialog" aria-labelledby="add_subcategorie_{{ $categorie->uuid }}_modal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="">Ajouter une sous-catégorie à {{{ $categorie->name }}}</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body">
                <form method="post" action="{{ route("admin.products.categories.store") }}">
                    @csrf
                    @method('POST')

                    <input type="hidden" name="id_categories" value="{{ $categorie->id }}">
                    
                    <div class="form-group ">
                        <label class="col-form-label" for="name">Libéllé (Display Name)</label>
                        <input class="form-control" id="name" type="text" name="name" required/>
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