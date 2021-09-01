<div class="sidebar-panel bg-white" style="background-image: url({{ url('images/sidebar2.jpg') }}) !important; background-position: 70% 20% !important; ">
    <div class="gull-brand pr-3 text-center mt-4 mb-2 d-flex justify-content-center align-items-center"><img class="pl-3" src="{{ url('images/faviconobp.png') }}"  alt="alt" />
        <!--  <span class=" item-name text-20 text-primary font-weight-700">GULL</span> -->
        <div class="sidebar-compact-switch ml-auto"><span></span></div>
    </div>
    <!--  user -->
    <div class="scroll-nav ps ps--active-y" data-perfect-scrollbar="data-perfect-scrollbar" data-suppress-scroll-x="true">
        <div class="side-nav">
            <div class="main-menu">
                <ul class="metismenu" id="menu">
                    <li class="Ul_li--hover"><a href="{{ route('stock.index') }}"><i class="i-Bar-Chart text-20 mr-2 text-muted"></i><span class="item-name text-15 text-muted">Tableau de bord</span></a></li>
                    <li class="Ul_li--hover"><a class="has-arrow" href="#"><i class="i-Shop text-20 mr-2 text-muted"></i><span class="item-name text-15 text-muted">Stock</span></a>
                        <ul class="mm-collapse">
                            @foreach (Entreprise::all() as $data)
                                <li class="item-name"><a href="{{ route('stock.etat_stock.index',['slug'=> $data->slug]) }}"><i class="nav-icon i-Bell1"></i><span class="item-name">{{ $data->nom }}</span></a></li>
                            @endforeach
                            <li class="item-name"></li>
                            {{-- <li class="nav-item"><a href="#"><i class="nav-icon i-File-Horizontal-Text"></i><span class="item-name">Journal | entrées</span></a></li>
                            <li class="item-name"><a href="#"><i class="nav-icon i-File-Horizontal-Text"></i><span class="item-name">Journal | sorties</span></a></li> --}}
                        </ul>
                    </li>
                    <li class="Ul_li--hover"><a class="has-arrow" href="#"><i class="i-Full-Cart text-20 mr-2 text-muted"></i><span class="item-name text-15 text-muted">Produit</span></a>
                        <ul class="mm-collapse">
                            <li class="nav-item"><a href="{{ route('stock.products.index') }}"><i class="nav-icon i-File-Horizontal-Text"></i><span class="item-name">Liste</span></a></li>
                            <li class="item-name"><a href="{{ route('stock.categories_prod.index') }}"><i class="nav-icon i-File-Horizontal-Text"></i><span class="item-name">Catégories</span></a></li>
                        </ul>
                    </li>
                    <li class="Ul_li--hover"><a class="has-arrow" href="#"><i class="i-Checkout-Bag text-20 mr-2 text-muted"></i><span class="item-name text-15 text-muted">Commandes</span></a>
                        <ul class="mm-collapse">
                            <li class="nav-item"><a href="{{ route('commande.index') }}"><i class="nav-icon i-File-Horizontal-Text"></i><span class="item-name">Liste</span></a></li>
                            <li class="item-name"><a href="{{ route('boncommande.index') }}"><i class="nav-icon i-File-Horizontal-Text"></i><span class="item-name">Bon de commande</span></a></li>
                            <li class="item-name"><a href="{{ route('commande_fournisseur.index') }}"><i class="nav-icon i-File-Horizontal-Text"></i><span class="item-name">Commande fournisseur</span></a></li>
                        </ul>
                    </li>
                    <li class="Ul_li--hover"><a href="{{ route('facture.index') }}"><i class="i-Billing text-20 mr-2 text-muted"></i><span class="item-name text-15 text-muted">Factures</span></a></li>
                    <li class="Ul_li--hover"><a href="{{ route('livraison.index') }}"><i class="i-Car text-20 mr-2 text-muted"></i><span class="item-name text-15 text-muted">Livraisons</span></a></li>
                    <li class="Ul_li--hover"><a href="{{ route('stock.client.index') }}"><i class="i-Add-UserStar text-20 mr-2 text-muted"></i><span class="item-name text-15 text-muted">Client</span></a></li>
                    <li class="Ul_li--hover"><a class="has-arrow" href="#"><i class="i-Affiliate text-20 mr-2 text-muted"></i><span class="item-name text-15 text-muted">Fournisseurs</span></a>
                        <ul class="mm-collapse">
                            <li class="nav-item"><a href="{{ route('stock.fournisseur.index') }}"><i class="nav-icon i-File-Horizontal-Text"></i><span class="item-name">Liste</span></a></li>
                            <li class="item-name"><a href="{{ route('stock.type_fournisseur.index') }}"><i class="nav-icon i-File-Horizontal-Text"></i><span class="item-name">Types</span></a></li>
                        </ul>
                    </li>
                    

                    <li class="Ul_li--hover"><a href="{{ route('stock.entreprise.index') }}"><i class="i-Building text-20 mr-2 text-muted"></i><span class="item-name text-15 text-muted">Entrepôt</span></a></li>

                    <!--  <p class="main-menu-title text-muted ml-3 font-weight-700 text-13 mt-4 mb-2">UI Elements</p> -->
                </ul>
            </div>
        </div>
        <div class="ps__rail-x" style="left: 0px; bottom: 0px;">
            <div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div>
        </div>
        <div class="ps__rail-y" style="top: 0px; height: 404px; right: 0px;">
            <div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 325px;"></div>
        </div>
        <div class="ps__rail-x" style="left: 0px; bottom: 0px;">
            <div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div>
        </div>
        <div class="ps__rail-y" style="top: 0px; height: 404px; right: 0px;">
            <div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 325px;"></div>
        </div>
    </div>
    <!--  side-nav-close -->
</div>