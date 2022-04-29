@extends('main.achats.partials.main')

@section('title', 'Ajout de Fiches de besoins -')

{{-- @section('stylesheets')
<style>
    label {
    margin-top: 35px;
    margin-bottom: 20px !important;
    display: flex;
    margin-bottom: 0.5rem;
}
</style>
@endsection --}}

@section('menuTitle')
Ajout Expressions Besoins
@endsection

@section('pageTitle')
Ajout de fiches de besoins
@endsection

@section('content')
<div class="row justify-content-center">
    <div class="container-fluid">
        <section class="ul-product-detail__box">
            <div class="row">
                    <div class="col-lg-3 col-md-3 mt-1 mb-4 text-center">
                        <a href="{{ route('stock.products.index')}}">
                        <div class="card">
                            <div class="card-body">
                                <div class="ul-product-detail__border-box">
                                    <div class="ul-product-detail--icon mb-2"><i class="i-Check text-success text-25 font-weight-500"></i></div>
                                    <h5 class="heading">Liste des fiches</h5>
                                    <p class="text-muted text-12">Afficher la liste de toutes les fiches.</p>
                                </div>
                            </div>
                        </div>
                    </a>
                    </div>
            </div>
        </section>
        <div class="card animate__animated animate__backInDown">
            <div class="card-header bg-transparent">
                <h3 class="card-title">Ajout d'une nouvelle fiche</h3>
            </div>
            <form method="post" action="{{ route('achats.besoins.store')}}">
                @csrf
                @method('POST')
                <div class="card-body">
                    <div class="form-row">
                        <div class="col-md-6 form-group mb-3">
                            <label for="lib">Libellé fiche</label>
                            <input class="form-control @error('lib') is-invalid @enderror" id="lib" name="lib" value="{{ old('lib') }}" type="text" placeholder="Entrez le libellé de la fiche" required />
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
                                @forelse ($entreprises as $entreprise)
                                <option value="{{ $entreprise->id }}">{{ $entreprise->name }}</option>
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
                            <label for="employe">Employé</label>
                            <input class="form-control @error('employe') is-invalid @enderror" id="employe" name="employe" value="{{ old('employe') }}" type="text" placeholder="Entrez le nom complet de l'employé" />
                            @if ($errors->has('employe'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('employe') }}
                                </div>
                            @endif
                        </div>
                        <div class="col-md-6 form-group mb-3">
                            <label for="contact">Contact entrepôt</label>
                            <input class="form-control @error('contact') is-invalid @enderror" id="contact" name="contact" value="{{ old('contact') }}" type="text" placeholder="Entrez le téléphone de la fiche" data-inputmask='"mask": "+(225) 99-99-99-99-99"' data-mask />
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
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('javascripts')
<script>
    $('[data-mask]').inputmask();
</script>
@endsection