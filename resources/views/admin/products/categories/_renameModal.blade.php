@php
    $type = $type ?? 'catégorie';
    $model = $type == 'catégorie' ? $categorie : $subcategorie;
@endphp
<div class="modal fade" id="rename_categorie_{{ $model->uuid }}_modal" tabindex="-1" role="dialog" aria-labelledby="rename_categorie_{{ $model->uuid }}_modal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="">Renommer la {{ $type != 'catégorie' ? 'sous' : '' }} catégorie {{{ $model->name }}}</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body">
                <form method="post" action="{{ route("admin.products.categories.update", $model) }}">
                    @csrf
                    @method('PUT')

                    <div class="form-group ">
                        <label class="col-form-label" for="name">Libéllé (Display Name)</label>
                        <input class="form-control" id="name" type="text" name="name" value="{{ $model->name }}" required/>
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