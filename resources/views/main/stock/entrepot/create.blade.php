@extends('main.stock.partials.main')

@section('stylesheets')

@endsection

@section('menuTitle')
Entrepôt
@endsection

@section('pageTitle')
Ajouter un entrepôt
@endsection

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6 col-offset-3">
        <div class="card mb-4">
            <div class="card-body">
                <div class="card-title mb-3 ">Formulaire d'ajout d'un entrepôt</div>
                <form method="post" action="{{ route('stock.entrepot.store')}}">
                    @csrf
                    @method('POST')
                    <div class="row">
                        <div class="col-md-6 form-group mb-3">
                            <label for="lib">Libellé entrepôt</label>
                            <input class="form-control @error('lib') is-invalid @enderror" id="lib" name="lib" value="{{ old('lib') }}" type="text" placeholder="Entrez le libellé de l'entrepôt" required />
                            @if ($errors->has('lib'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('lib') }}
                                </div>
                            @endif
                        </div>
                        <div class="col-md-6 form-group mb-3">
                            <label for="id_entreprise">Entreprise</label> 
                            <select name="id_entreprise" id="id_entreprise" class="form-control @error('id_entreprise') is-invalid @enderror" required>
                                <option value="0" disabled selected>Choisir une entreprise</option>
                                @forelse (Entreprise::where(['status' => 1])->get() as $data)
                                <option value="{{ $data->id }}">{{ $data->nom }}</option>
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
                            <input class="form-control @error('lieu') is-invalid @enderror" id="lieu" name="lieu" value="{{ old('lieu') }}" type="text" placeholder="Entrez la situation géographique de l'entrepôt" />
                            @if ($errors->has('lieu'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('lieu') }}
                                </div>
                            @endif
                        </div>
                        <div class="col-md-6 form-group mb-3">
                            <label for="contact">Contact entrepôt</label>
                            <input class="form-control @error('contact') is-invalid @enderror" id="contact" name="contact" value="{{ old('contact') }}" type="text" placeholder="Entrez le téléphone de l'entrepôt" data-inputmask='"mask": "+(225) 99-99-99-99-99"' data-mask />
                            @if ($errors->has('contact'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('contact') }}
                                </div>
                            @endif
                        </div>
    
                        <div class="col-md-12">
                            <button class="btn btn-primary">Valider</button>
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