<!DOCTYPE html>
<html lang="en" dir="">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>@yield('title') {{ $moduleTitle ?? '' }} | {{ $entrepriseTitle ?? 'Oholiab Group' }}</title>
    {{--<link rel="icon" href="{{ url('images/main_img/favicon/favicon-32x32.png') }}" type="image/x-icon">--}}
    <link href="https://fonts.googleapis.com/css?family=Nunito:300,400,400i,600,700,800,900" rel="stylesheet" />
    @php
        $a = Auth::user()->entreprise->id ?? 1;
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
    <link href="{{ url('css/plugins/pickadate/classic.min.css') }}" rel="stylesheet" />
    <link href="{{ url('css/plugins/pickadate/classic.date.min.css') }}" rel="stylesheet" />
    <link href="{{ url('css/plugins/bootstrap-datetimepicker.min.css') }}" rel="stylesheet" />
    <link href="{{ url('css/plugins/jquery.datatables.min.css') }}" rel="stylesheet" />
    <link href="{{ url('css/plugins/buttons.datatables.min.css') }}" rel="stylesheet" />
    <link href="{{ url('css/plugins/daterangepicker.css') }}" rel="stylesheet" />
    {{-- <link href="{{ url('css/plugins/toastr.css') }}" rel="stylesheet" /> --}}
    {{-- <link href="{{ url('css/plugins/select2.min.css') }}" rel="stylesheet" /> --}}
    {{-- <link href="{{ url('css/plugins/bootstrap-colorpicker.min.css') }}" rel="stylesheet" /> --}}
    {{-- <link href="{{ url('css/plugins/sweetalert2.min.css') }}" rel="stylesheet" /> --}}
    <link href="{{ url('fonts/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    
    <link href="{{ asset('myplugins/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('myplugins/HoldOn/HoldOn.min.css') }}" rel="stylesheet" />

    <style>
        /* Make the badge float in the top right corner of the button */
        .button__badge {
            background-color: red;
            border-radius: 50%;
            color: white;

            height: 18px;
            width: 18px;

            text-align: center;
            
            padding: 0 2px;
            font-size: 12px;
            
            position: absolute; /* Position the badge within the relatively positioned button */
            top: 0;
            right: 2px;
        }
    </style>
    @yield('stylesheets')
    
</head>

<body class="text-left" style="background-image: url({{ url('images/back1.jpg') }}) !important; background-position: center center !important; ">
    <div class="app-admin-wrap layout-sidebar-vertical sidebar-full">
        
        @include('main.partials.sidebar')

        {{-- <div class="switch-overlay"></div> --}}
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
                {{-- <div class="spinner-bubble spinner-bubble-primary" style="z-index: 10000;"></div> --}}

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
    <script src="{{ url('js/plugins/moment-with-locales.min.js')}}"></script>
    <script src="{{ url('js/plugins/pickadate/legacy.min.js')}}"></script>
    <script src="{{ url('js/plugins/pickadate/picker.min.js')}}"></script>
    <script src="{{ url('js/plugins/pickadate/picker.date.min.js')}}"></script>
    <script src="{{ url('js/plugins/bootstrap-datetimepicker.min.js')}}"></script>
    <script src="{{ url('js/plugins/daterangepicker.js')}}"></script>
    <script src="{{ url('js/scripts/form.validation.script.min.js')}}"></script>
    <script src="{{ url('js/plugins/apexcharts.min.js') }}"></script>
    {{-- <script src="{{ url('js/plugins/toastr.min.js')}}"></script> --}}
    {{-- <script src="{{ url('js/scripts/toastr.script.min.js')}}"></script> --}}
    {{-- <script src="{{ url('js/plugins/sweetalert2.min.js')}}"></script> --}}
    {{-- <script src="{{ url('js/plugins/bootstrap-colorpicker.min.js')}}"></script> --}}
    {{-- <script src="{{ url('js/scripts/sweetalert.script.min.js')}}"></script> --}}
    {{-- <script src="{{ url('js/plugins/form-picker-data.js')}}"></script> --}}
    
    <script src="{{ asset('myplugins/sweetalert2/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('myplugins/HoldOn/HoldOn.min.js') }}"></script>
    <script src="{{ asset('myplugins/HoldOn/HoldOn.min.js') }}"></script>

    <script>
        $('#ul-contact-list').DataTable();
    </script>
    <script>
        $('[data-mask]').inputmask();
    </script>
    <script src="{{ url('js/plugins/select2/js/select2.full.min.js') }}"></script>
    <script>
        const Toast = Swal.mixin({
            toast: true,
            position: 'top',
            showConfirmButton: false,
            timer: 5000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        })


        $(function() {
            //Initialize Select2 Elements
            $('.select2').select2({ tags: true });
            
            $('.select2n').select2({ });
            
            //Initialize Select2 Elements
            $('.select2bs4').select2({ theme: 'bootstrap4' });
        });
    </script>
    <script>
        @if(Session::has('message'))
            $(document).ready(function(){
                // toastr.info("{{ Session::get('message') }}");
                if("{{ Session::has('message') }}")
                var type = "{{ Session::get('alert-type', 'info') }}";
                switch(type){
                    case 'info':
                    case 'warning':
                    case 'success':
                    case 'error':
                        Toast.fire({
                            icon: type,
                            title: "{{ Session::get('message') }}"
                        })
                    break;
                }
            })
        @endif
    </script>
    <script>
        $(document).ready(function () {
            $('.table_oholiab').each(function(){
                $this = $(this);
                $toExport = $this.data('to-export') ?? [':visible'];
                $title = $this.data('title-to-display') ?? '[ Votre titre ici ]';
                $this.DataTable({
                    paging: true,
                    // ordering:false,
                    "language": {
                        "url": "{{ url('js/language/french_json.json')}}"
                    },
                    searching: true,
                    dom: 'Bfrtip',
                    buttons: [
                        {
                            extend:'copy',
                            title: $title,
                            exportOptions: {
                                columns: $toExport,
                            }
                        },
                        {
                            extend:'csv',
                            title: $title,
                            exportOptions: {
                                columns: $toExport,
                            }
                        },
                        {
                            extend:'excel',
                            title: $title,
                            exportOptions: {
                                columns: $toExport,
                            }
                        },
                        {
                            extend:'pdf',
                            title: $title,
                            exportOptions: {
                                columns: $toExport,
                            }
                        },
                        {
                            extend:'print',
                            title: $title,
                            exportOptions: {
                                columns: $toExport,
                            }
                        },
                    ]
                });
            })

            $('.collapseAll').click(function(){
                $('.collapse-table').each(function(){
                    element = $(this);
                    if(element.hasClass('show')){
                        parent = $(element).parent();
                        $(parent).find('.collapseBtn:first').click()
                    }
                })
            });
            $('.expandAll').click(function(){
                $('.collapse-table').each(function(){
                    element = $(this);
                    if(!element.hasClass('show')){
                        parent = $(element).parent();
                        $(parent).find('.collapseBtn:first').click()
                    }
                })
            });

            $('.collapseBtn').click(function(){
                console.log($(this).html())
                if($(this).hasClass('collapsed')){
                    $($(this).find('i:first')).removeClass('i-Arrow-Down-2').addClass('i-Arrow-Up-2')
                    // $(this).html('<i class="i-Arrow-Up-2 t-font-boldest"></i>')
                } else {
                    $($(this).find('i:first')).removeClass('i-Arrow-Up-2').addClass('i-Arrow-Down-2')
                    // $(this).html('<i class="i-Arrow-Down-2 t-font-boldest"></i>')
                }
            })

            $('.hover2display').on('mouseover', function(){
                $($(this).find('.displayHover')).removeClass('d-none');
            })
            
            $('.hover2display').on('mouseout', function(){
                $($(this).find('.displayHover')).addClass('d-none');
            })

            $('tr.tr-link, .notifLink').each(function(){
                $(this).css({'cursor':'pointer'});
                $(this).click(function(){
                    link = $(this).data('link');
                    if(link != '#') window.location.assign(link);
                })
            })
        })
    </script>
    @yield('javascripts')
</body>

</html>