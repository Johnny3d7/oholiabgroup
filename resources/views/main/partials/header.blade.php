<header class="main-header bg-white d-flex justify-content-between p-2">
    <div class="header-toggle">
        <div class="menu-toggle mobile-menu-icon">
            <div></div>
            <div></div>
            <div></div>
            </div><a href="{{ route('stock.product.create') }}" style="text-decoration: none !important;"><i class="i-Full-Cart mr-3 text-20 cursor-pointer" data-toggle="tooltip" data-placement="top" title="" data-original-title="Créer un produit"></i></a><a href="{{ route('stock.products.index') }}"><i class="i-Check mr-3 text-20 cursor-pointer" data-toggle="tooltip" data-placement="top" title="" data-original-title="Liste des produits"></i></a>
        </div>
        <div class="header-part-right">
            <!-- Full screen toggle--><i class="i-Full-Screen header-icon d-none d-sm-inline-block" data-fullscreen=""></i>
            <!-- Grid menu Dropdown-->
            {{-- <div class="dropdown dropleft"><i class="i-Safe-Box text-muted header-icon" id="dropdownMenuButton" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></i>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <div class="menu-icon-grid"><a href="#"><i class="i-Shop-4"></i> Home</a><a href="#"><i class="i-Library"></i> UI Kits</a><a href="#"><i class="i-Drop"></i> Apps</a><a href="#"><i class="i-File-Clipboard-File--Text"></i> Forms</a><a href="#"><i class="i-Checked-User"></i> Sessions</a><a href="#"><i class="i-Ambulance"></i> Support</a></div>
                </div>
            </div> --}}
        </div>
</header>