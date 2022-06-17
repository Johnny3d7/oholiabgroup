<div class="modal fade" id="rename_{{ $type }}_{{ $parametre->uuid }}_modal" tabindex="-1" role="dialog" aria-labelledby="rename_{{ $type }}_{{ $parametre->uuid }}_modal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="">Renommer {{ $type == 'type' ? 'le ' : ($type == 'unite' ? 'l\'' : 'la ') }}{{ $type }} {{{ $parametre->name }}}</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body">
                <form method="post" action="{{ route('admin.'.$type.'s.update', $parametre) }}">
                    @csrf
                    @method('PUT')

                    <div class="form-group ">
                        <label class="col-form-label" for="name">Libéllé (Display Name)</label>
                        <input class="form-control" id="name" type="text" name="name" value="{{ $parametre->name }}" required/>
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