<!DOCTYPE html>
<html lang="en" dir="">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Gestion de stock | Oholiab Group</title>
    {{--<link rel="icon" href="{{ url('images/main_img/favicon/favicon-32x32.png') }}" type="image/x-icon">--}}
    <link href="https://fonts.googleapis.com/css?family=Nunito:300,400,400i,600,700,800,900" rel="stylesheet" />
    @php
        $a =3 ;
    @endphp
    @if ($a == 1)
    <link href="{{ url('css/themes/lite-purple.css') }}" rel="stylesheet" />
    @elseif($a == 2)
    <link href="{{ url('css/themes/lite-akebie.css') }}" rel="stylesheet" />
    @elseif($a == 3)
    <link href="{{ url('css/themes/lite-obpinc.css') }}" rel="stylesheet" />
    @endif
    <link href="{{ url('css/plugins/perfect-scrollbar.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="{{ url('css/plugins/fontawesome-5.css') }}" />
    <link href="{{ url('css/plugins/metisMenu.min.css') }}" rel="stylesheet" />
    <link href="{{ url('css/plugins/ladda-themeless.min.css') }}" rel="stylesheet" />
    <link href="{{ url('css/plugins/toastr.css') }}" rel="stylesheet" />
    <link href="{{ url('css/plugins/sweetalert2.min.css') }}" rel="stylesheet" />
    <link href="{{ url('css/plugins/select2.min.css') }}" rel="stylesheet" />
    <link href="{{ url('css/plugins/pickadate/classic.min.css') }}" rel="stylesheet" />
    <link href="{{ url('css/plugins/pickadate/classic.date.min.css') }}" rel="stylesheet" />
    <link href="{{ url('css/plugins/bootstrap-datetimepicker.min.css') }}" rel="stylesheet" />
    <link href="{{ url('css/plugins/jquery.datatables.min.css') }}" rel="stylesheet" />
    <link href="{{ url('css/plugins/buttons.datatables.min.css') }}" rel="stylesheet" />
    <link href="{{ url('css/plugins/daterangepicker.css') }}" rel="stylesheet" />
    <link href="{{ url('css/plugins/bootstrap-colorpicker.min.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
 
    
    @yield('stylesheets')
    
</head>

<body class="text-left" style="background-image: url({{ url('images/back1.jpg') }}) !important; background-position: center center !important; ">
    <div class="app-admin-wrap layout-sidebar-vertical sidebar-full">

        @include('main.partials.sidebar')

        <div class="switch-overlay"></div>
        <div class="main-content-wrap mobile-menu-content bg-off-white m-0" style="background-image: url({{ url('images/back2.jpg') }}) !important; background-position: center center !important;     background-size: contain !important; ">
            @include('main.partials.header')

            <!-- ============ Body content start ============= -->
           <div class="main-content pt-4">
                <div class="breadcrumb">
                    <h1>@yield('pageTitle')</h1>
                    <ul>
                        <li><a href="{{ route('stock.index') }}">Accueil</a></li>
                        <li>@yield('menuTitle')</li>
                    </ul>
                </div>
                <div class="separator-breadcrumb border-top"></div>
                @yield('content')
                <!-- end of main-content -->
            </div>
            <div class="sidebar-overlay open"></div><!-- Footer Start -->
            @include('main.partials.footer')
            <!-- fotter end -->
        </div>
    </div>
    <!-- ============ Search UI Start ============= -->
    @include('main.partials.searchui')
    
    <!-- ============ Search UI End ============= -->
    <script src="{{ url('js/plugins/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ url('js/plugins/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ url('js/plugins/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ url('js/scripts/tooltip.script.min.js') }}"></script>
    <script src="{{ url('js/scripts/script.min.js') }}"></script>
    <script src="{{ url('js/scripts/script_2.min.js') }}"></script>
    <script src="{{ url('js/scripts/sidebar.large.script.min.js') }}"></script>
    <script src="{{ url('js/plugins/feather.min.js') }}"></script>
    <script src="{{ url('js/plugins/metisMenu.min.js') }}"></script>
    <script src="{{ url('js/scripts/layout-sidebar-vertical.min.js') }}"></script>
    <script src="{{ url('js/plugins/apexcharts.min.js') }}"></script>
    <script src="{{ url('js/scripts/card.metrics.script.min.js') }}"></script>
    <script src="{{ url('js/scripts/widgets-statistics.min.js') }}"></script>
    <script src="{{ url('js/plugins/echarts.min.js') }}"></script>
    <script src="{{ url('js/scripts/echart.options.min.js') }}"></script>
    <script src="{{ url('js/scripts/dashboard.v1.script.min.js') }}"></script>
    <script src="{{ url('js/plugins/datatables.min.js') }}"></script>
    <script src="{{ url('js/plugins/datatables.buttons.min.js') }}"></script>
    <script src="{{ url('js/plugins/jszip.min.js') }}"></script>
    <script src="{{ url('js/plugins/pdfmake.min.js') }}"></script>
    <script src="{{ url('js/plugins/vfs_fonts.js') }}"></script>
    <script src="{{ url('js/plugins/buttons.html5.min.js') }}"></script>
    <script src="{{ url('js/plugins/buttons.print.min.js') }}"></script>
    <script src="{{ url('js/plugins/buttons.colvis.min.js') }}"></script>
    <script src="{{ url('js/scripts/contact-list-table.min.js') }}"></script>
    <script src="{{ url('js/scripts/datatables.script.min.js') }}"></script>
    <script src="{{ url('js/plugins/spin.min.js') }}"></script>
    <script src="{{ url('js/plugins/ladda.min.js') }}"></script>
    <script src="{{ url('js/scripts/ladda.script.min.js') }}"></script>
    <script src="{{ url('js/plugins/inputmask/min/jquery.inputmask.bundle.min.js')}}"></script>
    <script src="{{ url('js/plugins/toastr.min.js')}}"></script>
    <script src="{{ url('js/scripts/toastr.script.min.js')}}"></script>
    <script src="{{ url('js/plugins/sweetalert2.min.js')}}"></script>
    <script src="{{ url('js/scripts/sweetalert.script.min.js')}}"></script>
    <script src="{{ url('js/plugins/moment-with-locales.min.js')}}"></script>
    <script src="{{ url('js/plugins/pickadate/legacy.min.js')}}"></script>
    <script src="{{ url('js/plugins/pickadate/picker.min.js')}}"></script>
    <script src="{{ url('js/plugins/pickadate/picker.date.min.js')}}"></script>
    <script src="{{ url('js/plugins/bootstrap-colorpicker.min.js')}}"></script>
    <script src="{{ url('js/plugins/bootstrap-datetimepicker.min.js')}}"></script>
    <script src="{{ url('js/plugins/daterangepicker.js')}}"></script>
    <script src="{{ url('js/plugins/form-picker-data.js')}}"></script>
    <script src="{{ url('js/scripts/form.validation.script.min.js')}}"></script>
    <script>
        $('#ul-contact-list').DataTable();
    </script>
    <script>
        $('[data-mask]').inputmask();
    </script>
    <script src="{{ url('js/plugins/select2/js/select2.full.min.js') }}"></script>
    <script>
        $(function() {
        //Initialize Select2 Elements
        $('.select2').select2({
        tags: true
        });
        
        $('.select2n').select2({
            
        });
        
        //Initialize Select2 Elements
        $('.select2bs4').select2({
        theme: 'bootstrap4'
        });
        });
    </script>
    <script>
        @if(Session::has('message'))
    var type = "{{ Session::get('alert-type', 'info') }}";
    switch(type){
        case 'info':
            toastr.info("{{ Session::get('message') }}");
            break;

        case 'warning':
            toastr.warning("{{ Session::get('message') }}");
            break;

        case 'success':
            toastr.success("{{ Session::get('message') }}");
            break;

        case 'error':
            toastr.error("{{ Session::get('message') }}");
            break;
    }
  @endif
    </script>
    @yield('javascripts')
</body>

</html>