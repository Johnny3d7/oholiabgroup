<div class="modal fade" id="add_permission_{{ $table }}_modal" tabindex="-1" role="dialog" aria-labelledby="add_permission_{{ $table }}_modal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="">Ajouter une permission à {{{ $table }}}</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body">
                <form method="post" action="{{ route("admin.permissions.store") }}">
                    @csrf
                    @method('POST')
                    
                    <div class="form-group ">
                        <label class="col-form-label" for="display_name">Libéllé (Display Name)</label>
                        <input class="form-control" id="display_name" type="text" name="display_name" required/>
                    </div>
                   
                    <div class="form-group ">
                        <label class="col-form-label" for="name">Code (Name)</label>
                        <input class="form-control" id="name" type="text" name="name" required/>
                    </div>
                    
                    <div class="form-group ">
                        <label class="col-form-label" for="table">Table (Group)</label>
                        <input class="form-control" id="table" type="text" name="table" required value="{{ $table }}"/>
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