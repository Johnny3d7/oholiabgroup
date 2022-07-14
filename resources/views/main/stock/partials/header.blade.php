{{-- <a href="{{ route('backStack') }}" style="text-decoration: none !important;">
    <i class="i-To-Left mr-3 text-20 cursor-pointer" data-toggle="tooltip" data-placement="top" title="" data-original-title="Retour"></i>
</a>
<a href="{{ route('stock.products.create') }}" style="text-decoration: none !important;">
    <i class="i-Full-Cart mr-3 text-20 cursor-pointer" data-toggle="tooltip" data-placement="top" title="" data-original-title="Créer un produit"></i>
</a>
<a href="{{ route('stock.products.index') }}">
    <i class="i-Check mr-3 text-20 cursor-pointer" data-toggle="tooltip" data-placement="top" title="" data-original-title="Liste des produits">
    </i>
</a> --}}
<!-- View mode toggle-->
@if (Route::currentRouteName() == 'stock.products.index')
@if (isset($view) && $view == "list")
    <a class="text-secondary" href="{{ route('stock.products.index') }}">
        <i class="i-Posterous header-icon d-none d-sm-inline-block" data-toggle="tooltip" data-palacement="top" data-original-title="Thumbnails view"></i>
    </a>
@else
    <a class="text-secondary" href="{{ route('stock.products.index', ['view' => 'list']) }}">
        <i class="i-Check header-icon d-none d-sm-inline-block" data-toggle="tooltip" data-palacement="top" data-original-title="List view"></i>
    </a>
@endif
@endif
