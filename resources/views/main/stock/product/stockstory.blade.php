@extends('main.stock.partials.main')

@section('title', 'Historique mouvements ['.$product->name.'] -')

@section('stylesheets')
<style>
    label {
    margin-top: 0px;
    margin-bottom: 20px !important;
    display: flex;
    margin-bottom: 0.5rem;
}
</style>
@endsection

@section('menuTitle')
Stock
@endsection

@section('pageTitle')
Historique des mouvements | {{ $product->name }}
@endsection

@section('content')
<section class="contact-list">
    <div class="row">
        <div class="col-md-12 mb-4">
            <div class="card text-left">
                <div class="card-header text-right bg-transparent">
                </div>
             
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="display table" id="inventaireTable" style="width:100%">
                            <thead>
                                <tr>
                                    <th style="width: 10%;">Date mouvement</th>
                                    <th style="width: 10%;">Type </th>
                                    <th style="width: 20%;">Entrepot</th>
                                    <th style="width: 10%;">Quantité</th>
                                    <th style="width: 30%;">Observation</th>
                                    <th style="width: 10%;">Date d'ajout</th>
                                    <th style="width: 10%;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($variations as $data)
                                    <tr>
                                        <td>
                                            {{ ucwords((new Carbon\Carbon($data->mouvement->date_mouvement))->locale('fr')->isoFormat('DD/MM/YYYY')) }}
                                        </td>
                                        <td>
                                            @if ($data->mouvement->type == 'in')
                                                <a class="badge badge-success m-2 p-2" href="#">Entrée</a>
                                            @endif
                                            @if ($data->mouvement->type == 'out')
                                                <a class="badge badge-info m-2 p-2" href="#">Sortie</a>
                                            @endif
                                        </td>
                                        <td>
                                            {{ $data->mouvement->entrepot->name }}
                                        </td>
                                        <td>
                                            {{ $data->quantite }}
                                        </td>
                                        <td>
                                            @if ($data->mouvement->observation == "")
                                                Néant
                                            @else
                                            {{ $data->mouvement->observation }}
                                            @endif
                                        </td>
                                        <td>{{ ucwords((new Carbon\Carbon($data->created_at))->locale('fr')->isoFormat('DD/MM/YYYY')) }}</td>
                                        <td>
                                            {{-- <button class="btn btn-outline-success m-1" type="button" data-toggle="modal" data-target="#updateVariation{{ $data->id }}" data-whatever="@fat">Modifier</button> --}}
                                            <a href="" class="text-success m-1" type="button" data-toggle="modal" data-target="#updateVariation{{ $data->id }}" data-whatever="@fat"><i class="i-Pen-3"></i></a>
                                            <a class="ul-link-action text-danger mr-1 deletevariation" href="{{ route('stock.variations.destroy', $data) }}" data-toggle="tooltip" data-placement="top" title="Voulez-vous supprimer!!!"><i class="i-Eraser-2"></i></a>
                                        </td>
                                    </tr>
                                    <div class="modal fade" id="updateVariation{{ $data->id }}" tabindex="-1" role="dialog" aria-labelledby="updateVariation{{ $data->id }}" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="updateVariation{{ $data->id }}_title">EFfectuer un mouvement </h5>
                                                <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                            </div>
                                            <div class="modal-body">
                                                <form method="get" action="{{ route('stock.variations.update', $data)}}">
                                                    @csrf
                                                    @method('GET')
                                                    <div class="form-group ">
                                                        <label class="col-form-label" for="typemouv">Nature mouvement:</label>
                                                        <select name="typemouv" class="form-control" id="typemouv" required>
                                                            @if ($data->typemouv == 1)
                                                                <option value="1" selected>Entrée</option>
                                                                <option value="0">Sortie</option>
                                                            @else
                                                            <option value="1" >Entrée</option>
                                                                <option value="0" selected>Sortie</option>
                                                            @endif
                                                                
                                                                
                                                        </select>
                                                    </div>
                                                    <div class="form-group ">
                                                        <label class="col-form-label" for="qte">Quantité mouvement:</label>
                                                        @if ($data->typemouv == 1)
                                                        <input class="form-control" id="qte" value="{{ $data->qte_entree }}" type="text" name="qte" required/>
                                                        @else
                                                        <input class="form-control" id="qte" value="{{ $data->qte_sortie }}" type="text" name="qte" required/>
                                                        @endif
                                                        
                                                    </div>
                                                    <div class="form-group ">
                                                        <label class="col-form-label" for="datemouv">Date mouvement:</label>
                                                        <input class="form-control" id="datemouv" type="text" name="datemouv" value="{{ ucwords((new Carbon\Carbon($data->datemouv))->locale('fr')->isoFormat('DD-MM-YYYY')) }}" data-inputmask='"mask": "99-99-9999"' data-mask required/>
                                                    </div>
                                                    <div class="form-group ">
                                                        <label class="col-form-label" for="observation">Observation:</label>
                                                        <textarea name="observation" id="observation" class="form-control">{{ $data->observation }}</textarea>
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
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('javascripts')
<script>
    $(document).ready(function() {
    $('#inventaireTable').DataTable({
        ordering:false,
        paging: true,
        searching: true,
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    } );
} );
</script>
<script>
    $(document).ready(function(){
        $('.deletevariatio').click(function (e) {
            e.preventDefault();
            
            swal({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#0CC27E',
                cancelButtonColor: '#FF586B',
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel!',
                confirmButtonClass: 'btn btn-success mr-5',
                cancelButtonClass: 'btn btn-danger',
                buttonsStyling: false
                }).then(function (value) {
                swal('Deleted!', 'Your imaginary file has been deleted.', 'success');
                
                if (value) {
                    e.returnValue = true;
                }
                
                    
                }, function (dismiss) {
                // dismiss can be 'overlay', 'cancel', 'close', 'esc', 'timer'
                if (dismiss === 'cancel') {
                    swal('Cancelled', 'Your imaginary file is safe :)', 'error');
                }
                });
        })
    });
</script>
@endsection