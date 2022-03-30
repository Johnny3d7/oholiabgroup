<div class="sidebar-panel bg-white" style="background-image: url({{ url('images/sidebar2.jpg') }}) !important; background-position: 70% 20% !important; ">
    <div class="gull-brand pr-3 text-center mt-4 mb-2 d-flex justify-content-center align-items-center">
        <div class="dropdown dropleft">
            {{-- <i class="i-Safe-Box text-muted header-icon" id="dropdownMenuButton" aria-haspopup="true" aria-expanded="false"></i> --}}
            <img class="pl-3" src="{{ url('images/logo.png') }}" role="button" data-toggle="dropdown" alt="alt" style="cursor: pointer;" />
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <div class="menu-icon-grid">
                    @if (1 == 0)
                        <a href="{{-- route('module.index') --}}">
                            <img class="w-100" src="{{ url('images/logo.png') }}"  alt="alt" />
                        </a>
                    @endif
                    <a href="{{-- route('module.index') --}}">
                        <img class="w-100" src="{{ url('images/faviconobp.png') }}"  alt="alt" />
                    </a>
                    <a href="{{-- route('module.index') --}}">
                        <img class="w-100" src="{{ url('images/logoakebie1.png') }}"  alt="alt" />
                    </a>
                </div>
            </div>
        </div>
        {{-- @if ($a == 1)
        <img class="pl-3" src="{{ url('images/logo.png') }}"  alt="alt" />
        @elseif($a == 2)
        <img class="pl-3" src="{{ url('images/logoakebie1.png') }}"  alt="alt" />
        @elseif($a == 3)
        <img class="pl-3" src="{{ url('images/faviconobp.png') }}"  alt="alt" />
        @endif --}}
        
        <!--  <span class=" item-name text-20 text-primary font-weight-700">GULL</span> -->
        <div class="sidebar-compact-switch ml-auto"><span></span></div>
    </div>
    
    <!--  user -->
    <div class="scroll-nav ps ps--active-y" data-perfect-scrollbar="data-perfect-scrollbar" data-suppress-scroll-x="true">
        <div class="side-nav">
            <div class="main-menu">
                @yield('module_sidebar')
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