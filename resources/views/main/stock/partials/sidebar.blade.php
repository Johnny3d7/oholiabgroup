@php
    $entreprise = Auth::user()->entreprise->id ?? 1;
@endphp
<ul class="metismenu" id="menu">
    {{-- <li class="Ul_li--hover"><a href="{{ route('stock.index') }}"><i class="i-Bar-Chart text-20 mr-2 text-muted"></i><span class="item-name text-15 text-muted">Tableau de bord</span></a></li> --}}
    @if ($entreprise == 1)
        <li class="Ul_li--hover"><a class="has-arrow" href="#"><i class="i-Shop text-20 mr-2 text-muted"></i><span class="item-name text-15 text-muted">Inventaire</span></a>
            <ul class="mm-collapse">
                <li class="item-name"><a href="{{-- route('stock.etat_stock.index',$data) --}}"><i class="nav-icon i-Bell1"></i><span class="item-name">Liste</span></a></li>
                @foreach (Entreprise::all() as $data)
                    <li class="item-name"><a href="{{-- route('stock.etat_stock.index',$data) --}}"><i class="nav-icon i-Bell1"></i><span class="item-name">{{ $data->name }}</span></a></li>
                @endforeach
                <li class="item-name"></li>
                {{-- <li class="nav-item"><a href="#"><i class="nav-icon i-File-Horizontal-Text"></i><span class="item-name">Journal | entrées</span></a></li>
                <li class="item-name"><a href="#"><i class="nav-icon i-File-Horizontal-Text"></i><span class="item-name">Journal | sorties</span></a></li> --}}
            </ul>
        </li>
    @else()
    <li class="Ul_li--hover"><a href="{{ route('stock.etat_stock.index',['slug'=> Auth::user()->entreprise->slug]) }}"><i class="i-Shop text-20 mr-2 text-muted"></i><span class="item-name text-15 text-muted">Inventaire</span></a></li>
    @endif
    
    <li class="Ul_li--hover"><a class="has-arrow" href="#"><i class="i-Full-Cart text-20 mr-2 text-muted"></i><span class="item-name text-15 text-muted">Produit</span></a>
        <ul class="mm-collapse">
            <li class="nav-item"><a href="{{ route('stock.products.create') }}"><i class="nav-icon i-File-Horizontal-Text"></i><span class="item-name">Nouveau</span></a></li>
            <li class="nav-item"><a href="{{ route('stock.products.index') }}"><i class="nav-icon i-File-Horizontal-Text"></i><span class="item-name">Liste</span></a></li>
            <li class="item-name"><a href="{{ route('stock.categories.index') }}"><i class="nav-icon i-File-Horizontal-Text"></i><span class="item-name">Catégories</span></a></li>
        </ul>
    </li>
    {{-- <li class="Ul_li--hover"><a class="has-arrow" href="#"><i class="i-Checkout-Bag text-20 mr-2 text-muted"></i><span class="item-name text-15 text-muted">Commandes</span></a>
        <ul class="mm-collapse">
            <li class="nav-item"><a href="{{ route('commande.index') }}"><i class="nav-icon i-File-Horizontal-Text"></i><span class="item-name">Liste</span></a></li>
            
        </ul>
    </li> --}}
    {{-- <li class="Ul_li--hover"><a class="has-arrow" href="#"><i class="i-Checkout-Bag text-20 mr-2 text-muted"></i><span class="item-name text-15 text-muted">Commandes fournisseur vvv</span></a>
        <ul class="mm-collapse">
            <li class="nav-item"><a href="{{ route('boncommande.index') }}"><i class="nav-icon i-File-Horizontal-Text"></i><span class="item-name">Liste</span></a></li>
           
        </ul>
    </li> --}}
    @if ($entreprise == 2 || $entreprise == 3)
        <li class="Ul_li--hover"><a class="has-arrow" href="#"><i class="i-Checkout-Bag text-20 mr-2 text-muted"></i><span class="item-name text-15 text-muted">Expression besoin</span></a>
            <ul class="mm-collapse">
                <li class="nav-item"><a href="{{ route('commande_fournisseur.index') }}"><i class="nav-icon i-File-Horizontal-Text"></i><span class="item-name">Liste</span></a></li>
            
            </ul>
        </li>
        <li class="Ul_li--hover"><a class="has-arrow" href="#"><i class="i-Checkout-Bag text-20 mr-2 text-muted"></i><span class="item-name text-15 text-muted">Commandes client</span></a>
            <ul class="mm-collapse">
                <li class="nav-item"><a href="{{ route('commande_fournisseur.recu') }}"><i class="nav-icon i-File-Horizontal-Text"></i><span class="item-name">Liste</span></a></li>
            
            </ul>
        </li>
    @elseif($entreprise == 1)
    {{-- <li class="Ul_li--hover"><a class="has-arrow" href="#"><i class="i-Checkout-Bag text-20 mr-2 text-muted"></i><span class="item-name text-15 text-muted">Commandes fournisseur</span></a>
        <ul class="mm-collapse">
            <li class="nav-item"><a href="{{ route('commande_fournisseur.index') }}"><i class="nav-icon i-File-Horizontal-Text"></i><span class="item-name">Liste</span></a></li>
           
        </ul>
    </li>
    <li class="Ul_li--hover"><a class="has-arrow" href="#"><i class="i-Checkout-Bag text-20 mr-2 text-muted"></i><span class="item-name text-15 text-muted">Expressions besoin</span></a>
        <ul class="mm-collapse">
            <li class="nav-item"><a href="{{ route('commande_fournisseur.recu') }}"><i class="nav-icon i-File-Horizontal-Text"></i><span class="item-name">Liste</span></a></li>
           
        </ul>
    </li> --}}
    <li class="Ul_li--hover"><a class="has-arrow" href="#"><i class="i-Checkout-Bag text-20 mr-2 text-muted"></i><span class="item-name text-15 text-muted">Entrepôts</span></a>
        <ul class="mm-collapse">
            <li class="nav-item"><a href="{{ route('stock.entrepots.index') }}"><i class="nav-icon i-File-Horizontal-Text"></i><span class="item-name">Liste</span></a></li>
            <li class="nav-item"><a href="{{-- route('stock.entrepots.create') --}}"><i class="nav-icon i-File-Horizontal-Text"></i><span class="item-name">Créer un entrepôt</span></a></li>
        </ul>
    </li>
    @endif
    
    {{-- <li class="Ul_li--hover"><a href="{{ route('facture.index') }}"><i class="i-Billing text-20 mr-2 text-muted"></i><span class="item-name text-15 text-muted">Factures</span></a></li> --}}
{{-- <li class="Ul_li--hover"><a href="{{ route('livraison.index') }}"><i class="i-Car text-20 mr-2 text-muted"></i><span class="item-name text-15 text-muted">Livraisons</span></a></li> --}}
    {{-- <li class="Ul_li--hover"><a href="{{ route('stock.client.index') }}"><i class="i-Add-UserStar text-20 mr-2 text-muted"></i><span class="item-name text-15 text-muted">Client</span></a></li> --}}

{{-- @if ($entreprise == 1)
<li class="Ul_li--hover"><a class="has-arrow" href="#"><i class="i-Affiliate text-20 mr-2 text-muted"></i><span class="item-name text-15 text-muted">Fournisseurs</span></a>
    <ul class="mm-collapse">
        <li class="nav-item"><a href="{{ route('stock.fournisseur.index') }}"><i class="nav-icon i-File-Horizontal-Text"></i><span class="item-name">Liste</span></a></li>
        <li class="item-name"><a href="{{ route('stock.type_fournisseur.index') }}"><i class="nav-icon i-File-Horizontal-Text"></i><span class="item-name">Types</span></a></li>
    </ul>
</li>
@endif --}}
    
    

    {{-- <li class="Ul_li--hover"><a href="{{ route('stock.entreprise.index') }}"><i class="i-Building text-20 mr-2 text-muted"></i><span class="item-name text-15 text-muted">Entrepôt</span></a></li> --}}
    

    <!--  <p class="main-menu-title text-muted ml-3 font-weight-700 text-13 mt-4 mb-2">UI Elements</p> -->
</ul>