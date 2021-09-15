@extends('main.modules.partials.main')

@section('stylesheets')

@endsection

@section('menuTitle')
Modules
@endsection

@section('pageTitle')
Liste des modules
@endsection

@section('content')

<section class="widget-card">
    <div class="row">
        <div class="col-lg-3 col-xl-3 mt-3">
            <div class="card"><img class="d-block w-100 rounded rounded" src="{{ url('images/products/iphone-1.jpg') }}" alt="First slide" />
                <div class="card-body">
                    <h5 class="card-title mb-2">Stock Production</h5>
                    <p class="card-text text-mute">Module</p>
                    <div class="mt-2">
                        <a href="{{ route('stock.products.index') }}"><button class="btn btn-primary btn-block m-1" type="button">Accéder</button></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-xl-3 mt-3">
            <div class="card"><img class="d-block w-100 rounded rounded" src="{{ url('images/products/iphone-1.jpg') }}" alt="First slide" />
                <div class="card-body">
                    <h5 class="card-title mb-2">Ventes</h5>
                    <p class="card-text text-mute">Module</p>
                    <div class="mt-2">
                        <button class="btn btn-primary btn-block m-1" type="button">Accéder</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-xl-3 mt-3">
            <div class="card"><img class="d-block w-100 rounded rounded" src="{{ url('images/products/iphone-1.jpg') }}" alt="First slide" />
                <div class="card-body">
                    <h5 class="card-title mb-2">Achats</h5>
                    <p class="card-text text-mute">Module</p>
                    <div class="mt-2">
                        <button class="btn btn-primary btn-block m-1" type="button">Accéder</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-xl-3 mt-3">
            <div class="card"><img class="d-block w-100 rounded rounded" src="{{ url('images/products/iphone-1.jpg') }}" alt="First slide" />
                <div class="card-body">
                    <h5 class="card-title mb-2">Parc Informatique</h5>
                    <p class="card-text text-mute">Module</p>
                    <div class="mt-2">
                        <button class="btn btn-primary btn-block m-1" type="button">Accéder</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-xl-3 mt-3">
            <div class="card"><img class="d-block w-100 rounded rounded" src="{{ url('images/products/iphone-1.jpg') }}" alt="First slide" />
                <div class="card-body">
                    <h5 class="card-title mb-2">Parc Automobile</h5>
                    <p class="card-text text-mute">Module</p>
                    <div class="mt-2">
                        <button class="btn btn-primary btn-block m-1" type="button">Accéder</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-xl-3 mt-3">
            <div class="card"><img class="d-block w-100 rounded rounded" src="{{ url('images/products/iphone-1.jpg') }}" alt="First slide" />
                <div class="card-body">
                    <h5 class="card-title mb-2">Comptabilité</h5>
                    <p class="card-text text-mute">Module</p>
                    <div class="mt-2">
                        <button class="btn btn-primary btn-block m-1" type="button">Accéder</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-xl-3 mt-3">
            <div class="card"><img class="d-block w-100 rounded rounded" src="{{ url('images/products/iphone-1.jpg') }}" alt="First slide" />
                <div class="card-body">
                    <h5 class="card-title mb-2">Ressources humaines</h5>
                    <p class="card-text text-mute">Module</p>
                    <div class="mt-2">
                        <button class="btn btn-primary btn-block m-1" type="button">Accéder</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-xl-3 mt-3">
            <div class="card"><img class="d-block w-100 rounded rounded" src="{{ url('images/products/iphone-1.jpg') }}" alt="First slide" />
                <div class="card-body">
                    <h5 class="card-title mb-2">Gestion commerciale</h5>
                    <p class="card-text text-mute">Module</p>
                    <div class="mt-2">
                        <button class="btn btn-primary btn-block m-1" type="button">Accéder</button>
                    </div>
                </div>
            </div>
        </div>
           
            
    </div>
</section><!-- end of main-content -->

@endsection

@section('javascripts')

@endsection