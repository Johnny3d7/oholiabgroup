@extends('main.layout.main')

@section('stylesheets')

@endsection

@section('menuTitle')
Stock
@endsection

@section('pageTitle')
Historique des mouvements | {{ $variations[0]->product_lib }}
@endsection

@section('content')
<section class="contact-list">
    <div class="row">
        <div class="col-md-8 mb-4">
            <div class="card text-left">
                <div class="card-header text-right bg-transparent">
                </div>
             
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="display table" id="ul-contact-list" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Date mouvement</th>
                                    <th>Type </th>
                                    <th>Quantité</th>
                                    <th>Observation</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($variations as $data)
                                    <tr>
                                        <td>{{ ucwords((new Carbon\Carbon($data->datemouv))->locale('fr')->isoFormat('DD/MM/YYYY')) }}</td>
                                        @if ($data->typemouv == 1)
                                        <td>
                                            <a class="badge badge-success m-2 p-2" href="#">Entrée</a>
                                        </td>
                                        <td>{{ $data->qte_entree }}</td>  
                                        @else
                                        <td>
                                            <a class="badge badge-success m-2 p-2" href="#">Sortie</a>
                                        </td>
                                        <td>{{ $data->qte_sortie }}</td>  
                                        @endif
                                        <td>
                                            @if ($data->observation == "")
                                                Néant
                                            @else
                                            {{ $data->observation }}
                                            @endif
                                            
                                        </td>        
                                        <td><a class="ul-link-action text-success" href="{{ route('stock.variation.update',['id'=>$data->id]) }}" data-toggle="tooltip" data-placement="top" title="Modifier" data-toggle="modal" data-target="#verifyModalContent{{ $data->id }}" data-whatever="@fat"><i class="i-Edit"></i></a><a class="ul-link-action text-danger mr-1 deletevariation" href="{{ route('stock.variation.destroy',['id'=>$data->id]) }}" data-toggle="tooltip" data-placement="top" title="Voulez-vous supprimer!!!"><i class="i-Eraser-2"></i></a></td>
                                    </tr>
                                    {{-- <div class="modal fade" id="verifyModalContent{{ $data->id }}" tabindex="-1" role="dialog" aria-labelledby="verifyModalContent{{ $data->id }}" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="verifyModalContent{{ $data->id }}_title">Modification d'un mouvement</h5>
                                                    <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form method="put" action="{{ route('stock.variation.update', ['id'=>$data->id])}}">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="form-group ">
                                                            <label class="col-form-label" for="lib">Quantité mouvement:</label>
                                                            <input class="form-control" id="lib" type="text" value="{{ $data->lib }}" name="lib" required/>
                                                        </div>
                                                        <div class="form-group ">
                                                            <label class="col-form-label" for="id_product_category">Type de mouvement</label>
                                                            <select name="id_product_category" class="form-control" required>
                                                                @forelse (ProductCategory::where('status', 1)->orderBy('lib', 'asc')->get() as $cat)
                                                                    @if ($data->productCategory->id == $cat->id)
                                                                    <option value="{{ $cat->slug }}" selected>{{ $cat->lib }}</option>
                                                                    @else
                                                                    <option value="{{ $cat->slug }}">{{ $cat->lib }}</option>
                                                                    @endif
                                                                    
                                                                @empty
                                                                    
                                                                @endforelse
                                                            </select>
                                                        </div>
                                                        <div class="form-group ">
                                                            <label class="col-form-label" for="id_type_product">Type produit:</label>
                                                            <select name="id_type_product" class="form-control" required>
                                                                @forelse (TypeProduct::where('status', 1)->orderBy('lib', 'asc')->get() as $type)
                                                                    @if ($data->typeProduct->id == $type->id)
                                                                    <option value="{{ $type->id }}" selected>{{ $type->lib }}</option>
                                                                    @else
                                                                    <option value="{{ $type->id }}">{{ $type->lib }}</option>
                                                                    @endif
                                                                    
                                                                @empty
                                                                    
                                                                @endforelse
                                                            </select>
                                                        </div>
                                                        <div class="form-group ">
                                                            <label class="col-form-label" for="datemouv">Date mouvement:</label>
                                                            <input class="form-control" id="datemouv" type="text" name="datemouv" value="{{ $data->datemouv }}" required/>
                                                        </div>
                                                        <div class="form-group ">
                                                            <label class="col-form-label" for="observation">Observation:</label>
                                                            <input class="form-control" id="observation" type="text" name="observation" value="{{ $data->observation }}" required/>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button class="btn btn-secondary" type="button" data-dismiss="modal">Fermer</button>
                                                            <button class="btn btn-primary" type="submit">Valider</button>
                                                        </div>
                                                    </form>
                                                    
                                                </div>
                                                
                                            </div>
                                        </div>
                                    </div>    --}}
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