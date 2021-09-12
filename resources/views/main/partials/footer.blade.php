<div class="flex-grow-1"></div>
    <div class="app-footer">
        <div class="footer-bottom  pt-3 d-flex flex-column flex-sm-row align-items-center">
        @if ($a == 1)
            <img class="logo" style="height: 50px; width:auto;" src="{{ url('images/logototal.png') }}" alt="">
        @elseif($a == 2)
            <img class="logo" style="height: 50px; width:auto;" src="{{ url('images/logoakebie1.png') }}" alt="">
        @elseif($a == 3)
            <img class="logo" style="height: 50px; width:auto;" src="{{ url('images/logoobp.png') }}" alt="">
        @endif
            
            {{-- <a class="btn btn-primary text-white btn-rounded" href="https://themeforest.net/item/gull-bootstrap-laravel-admin-dashboard-template/23101970" target="_blank">Buy Gull HTML</a> --}}
            <span class="flex-grow-1"></span>
            <div class="d-flex align-items-center">
                
                <div>
                    <p class="m-0">&copy; 2021 
                        @if ($a == 1)
                            OHOLIAB GROUP
                        @elseif($a == 2)
                            AKEBIE SARL
                        @elseif($a == 3)
                            OBP INC. SA
                        @endif 
                        | @yield('module_name')</p>
                    <p class="m-0">Tous droits réservés</p>
                </div>
            </div>
        </div>
    </div>
            