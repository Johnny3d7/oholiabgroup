<header class="main-header bg-white d-flex justify-content-between p-2" >
    <div class="header-toggle">
        <div class="menu-toggle mobile-menu-icon">
            <div></div>
            <div></div>
            <div></div>
            </div>
            @yield('raccourcis')
        </div>
        <div class="header-part-right">
            <!-- Full screen toggle-->
            <i class="i-Full-Screen header-icon d-none d-sm-inline-block" data-fullscreen=""></i>
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
            <!-- Grid menu Dropdown-->
             <div class="dropdown dropleft"><i class="i-Safe-Box text-muted header-icon" id="dropdownMenuButton" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></i>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <div class="menu-icon-grid"><a href="{{ route('module.index') }}"><i class="i-Shop-4"></i> Modules</a>
                        <a href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                                      document.getElementById('logout-form').submit();">
                         <i class="i-Close"></i> Déconnexion
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </div>
            </div>
        </div>
</header>