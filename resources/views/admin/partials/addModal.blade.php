@php
    $genre = $genre ?? 'M';
    $model = $model ?? '';
@endphp
<div class="modal fade" id="add_{{ $type }}_modal" tabindex="-1" role="dialog" aria-labelledby="add_{{ $type }}_modal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="">Ajouter un{{ ($genre == 'M' ? ' ' : 'e ').$type }}</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body">
                <form method="post" action="{{-- route("admin.".$model.$type."s.store") --}}">
                    @csrf
                    @method('POST')
                    
                    <div class="form-group ">
                        <label class="col-form-label" for="name">Libéllé d{{ ($genre == 'M' ? 'u ' : ($genre == 'F' ? 'e la ' : 'e l\'')).$type }}:</label>
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