@extends('main.stock.partials.main')

@section('stylesheets')

@endsection

@section('menuTitle')
Entrepôt
@endsection

@section('pageTitle')
Modifier entrepôt {{ $entrepot->ref }} 
@endsection

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6 col-offset-3">
        <div class="card mb-4">
            <div class="card-body">
                <div class="card-title mb-3 ">Formulaire de modification de l'entrepôt <a href="{{ route('stock.entrepot.show',['slug'=>$entrepot->slug  ])}}">{{ $entrepot->ref }}</a></div>
                <form method="put" action="{{ route('stock.entrepot.update',['slug'=> $entrepot->slug])}}">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-6 form-group mb-3">
                            <label for="lib">Libellé entrepôt</label>
                            <input class="form-control @error('lib') is-invalid @enderror" id="lib" name="lib" value="{{ $entrepot->lib }}" type="text" placeholder="Entrez le libellé de l'entrepôt" required />
                            @if ($errors->has('lib'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('lib') }}
                                </div>
                            @endif
                        </div>
                        <div class="col-md-6 form-group mb-3">
                            <label for="id_entreprise">Entreprise</label> 
                            <select name="id_entreprise" id="id_entreprise" class="form-control @error('id_entreprise') is-invalid @enderror" required>
                                <option value="0" disabled>Choisir une entreprise</option>
                                @forelse (Entreprise::where(['status' => 1])->get() as $data)
                                <option {{ $data->id == $entrepot->entreprise->id ? 'selected' : ''}} value="{{ $data->id }}">{{ $data->nom }}</option>
                                @empty
                                    
                                @endforelse
                            </select>                            
                            @if ($errors->has('id_entreprise'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('id_entreprise') }}
                                </div>
                            @endif
                        </div>
                        <div class="col-md-6 form-group mb-3">
                            <label for="lieu">Lieu entrepôt</label>
                            <input class="form-control @error('lieu') is-invalid @enderror" id="lieu" name="lieu" value="{{ $entrepot->lieu ? $entrepot->lieu : '' }}" type="text" placeholder="Entrez la situation géographique de l'entrepôt" />
                            @if ($errors->has('lieu'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('lieu') }}
                                </div>
                            @endif
                        </div>
                        <div class="col-md-6 form-group mb-3">
                            <label for="contact">Contact entrepôt</label>
                            <input class="form-control @error('contact') is-invalid @enderror" id="contact" name="contact" value="{{ $entrepot->contact ? $entrepot->contact : '' }}" type="text" placeholder="Entrez le téléphone de l'entrepôt" data-inputmask='"mask": "+(225) 99-99-99-99-99"' data-mask />
                            @if ($errors->has('contact'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('contact') }}
                                </div>
                            @endif
                        </div>
    
                        <div class="col-md-12">
                            <button class="btn btn-primary">Mettre à jour</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('javascripts')
<script>
    $('[data-mask]').inputmask();
</script>
@endsection