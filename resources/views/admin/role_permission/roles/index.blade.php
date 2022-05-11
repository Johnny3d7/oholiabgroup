@extends('admin.partials.main')

@section('raccourcis')
    @include('admin.role_permission.roles._header')
@endsection

@section('stylesheets')
<style>
    .ul-widget1{
        height: 400px;
        overflow-y: auto;
    }
</style>
@endsection

@section('menuTitle')
Roles
@endsection

@section('pageTitle')
Roles
@endsection

@section('content')
@include('admin.partials.addModal', ['type' => 'role'])
<div class="row">
    <div class="col">
        <button class="btn btn-outline-primary float-right expandAll"><i class="i-Arrow-Down-2 t-font-boldest"></i> Expand all</button>
    </div>
    <div class="col">
        <button class="btn btn-outline-primary collapseAll"><i class="i-Arrow-Up-2 t-font-boldest"></i> Collapse all</button>
    </div>
</div>
<div class="row mb-4">
    @forelse ($roles->sortBy('name') as $role)
        <div class="col-lg-4 col-md-6 col-xl-4 mt-4">
            <div class="card h-100">
                <div class="card-body pr-1">
                    <div class="ul-widget__head">
                        <div class="ul-widget__head-label">
                            <h3 class="ul-widget__head-title text-primary">
                                {{ $role->name }}
                            </h3>
                        </div>
                        <div class="ul-widget__head-toolbar">
                            <ul class="nav nav-tabs nav-tabs-line nav-tabs-bold ul-widget-nav-tabs-line" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active show" data-toggle="tab" href="#roles-users-{{ $role->name }}" role="tab" aria-selected="true">
                                        <i class="i-Male-21"></i>
                                        <span class="pl-1">
                                            Utilisateurs
                                        </span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#roles-permissions-{{ $role->name }}" role="tab" aria-selected="false">
                                        <i class="i-Affiliate"></i>
                                        <span class="pl-1">
                                            Permissions
                                        </span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="ul-widget__body">
                        <div class="tab-content pr-1">
                            <div class="tab-pane active show" id="roles-users-{{ $role->name }}">
                                <div class="ul-widget1 pr-3" id="collapse-icon-{{ $role->name }}">
                                    @for ($i = 0; $i < 6; $i++)
                                        <div class="ul-widget4__item ul-widget4__users">
                                            <div class="ul-widget4__img">
                                                <img id="userDropdown" src="{{ asset('images/faces/2.jpg') }}" alt="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            </div>
                                            <div class="ul-widget2__info ul-widget4__users-info">
                                                <a class="ul-widget2__title" href="#">Anna Strong</a>
                                                <span class="ul-widget2__username" href="#">Visual Designer,Google Inc</span>
                                            </div>
                                            <div class="ul-widget4__actions">
                                                <button class="btn bg-white _r_btn border-0" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    {{-- <span class="_dot _inline-dot bg-primary mr-1"></span><span class="_dot _inline-dot bg-primary mr-1"></span><span class="_dot _inline-dot bg-primary mr-1"></span> --}}

                                                    <span class="_dot _r_block-dot bg-dark"></span>
                                                    <span class="_dot _r_block-dot bg-dark"></span>
                                                    <span class="_dot _r_block-dot bg-dark"></span>
                                                </button>
                                                <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(895px, 144px, 0px);">
                                                    <a class="dropdown-item ul-widget__link--font" href="#"><i class="i-Bar-Chart-4"> </i> Export</a>
                                                    <a class="dropdown-item ul-widget__link--font" href="#"><i class="i-Data-Save"> </i> Save</a>
                                                    <a class="dropdown-item ul-widget__link--font" href="#"><i class="i-Duplicate-Layer"></i> Import</a>
                                                    <div class="dropdown-divider"></div>
                                                    <a class="dropdown-item ul-widget__link--font" href="#"><i class="i-Folder-Download"></i> Update</a>
                                                    <a class="dropdown-item ul-widget__link--font" href="#"><i class="i-Gears-2"></i> Customize</a>
                                                </div>
                                                {{-- <button class="btn btn-outline-danger m-1" type="button">Follow</button> --}}
                                            </div>
                                        </div>
                                    @endfor
                                    
                                </div>
                            </div>
                            <div class="tab-pane" id="roles-permissions-{{ $role->name }}">
                                <div class="ul-widget1 pr-3">
                                    <div class="ul-widget4__item ul-widget4__users">
                                        <div class="ul-widget4__img"><img id="userDropdown" src="../../dist-assets/images/faces/2.jpg" alt="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></div>
                                        <div class="ul-widget2__info ul-widget4__users-info"><a class="ul-widget2__title" href="#">Anna Strong</a><span class="ul-widget2__username" href="#">Visual Designer,Google Inc</span></div>
                                        <div class="ul-widget4__actions">
                                            <button class="btn btn-outline-danger m-1" type="button">Follow</button>
                                        </div>
                                    </div>
                                    <div class="ul-widget4__item ul-widget4__users">
                                        <div class="ul-widget4__img"><img id="userDropdown" src="../../dist-assets/images/faces/1.jpg" alt="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></div>
                                        <div class="ul-widget2__info ul-widget4__users-info"><a class="ul-widget2__title" href="#">Anna Strong</a><span class="ul-widget2__username" href="#">Visual Designer,Google Inc</span></div>
                                        <div class="ul-widget4__actions">
                                            <button class="btn btn-outline-success m-1" type="button">Follow</button>
                                        </div>
                                    </div>
                                    <div class="ul-widget4__item ul-widget4__users">
                                        <div class="ul-widget4__img"><img id="userDropdown" src="../../dist-assets/images/faces/3.jpg" alt="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></div>
                                        <div class="ul-widget2__info ul-widget4__users-info"><a class="ul-widget2__title" href="#">Anna Strong</a><span class="ul-widget2__username" href="#">Visual Designer,Google Inc</span></div>
                                        <div class="ul-widget4__actions">
                                            <button class="btn btn-outline-warning m-1" type="button">Follow</button>
                                        </div>
                                    </div>
                                    <div class="ul-widget4__item ul-widget4__users">
                                        <div class="ul-widget4__img"><img id="userDropdown" src="../../dist-assets/images/faces/4.jpg" alt="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></div>
                                        <div class="ul-widget2__info ul-widget4__users-info"><a class="ul-widget2__title" href="#">Anna Strong</a><span class="ul-widget2__username" href="#">Visual Designer,Google Inc</span></div>
                                        <div class="ul-widget4__actions">
                                            <button class="btn btn-outline-info m-1" type="button">Follow</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>




        {{-- <div class="col-md-3 py-3">
            <div class="card card-body ul-border__bottom">
                <div class="text-center">
                    <h5 class="heading text-primary">{{ $role->name }}</h5>
                    <a class="text-default collapseBtn" href="#collapse-icon-{{ $role->name }}" data-toggle="collapse" aria-expanded="false">
                        <i class="i-Arrow-Up-2 t-font-boldest"></i>
                    </a>
                </div>
                <div class="collapse collapse-table show" id="collapse-icon-{{ $role->name }}" style="">
                    <div class="mt-3">
                        <ul class="list-group">
                            @foreach ($role->permissions as $perm)
                                <li class="list-group-item disabled">{{ $perm->display_name }}</li>
                            @endforeach
                            
                        </ul>
                    </div>
                </div>
            </div>
        </div> --}}
    @empty
    <div class="container">
        <h6 class="text-center">Aucune donnée disponible</h6>
    </div>
    @endforelse
</div>
@endsection

@section('javascripts')
    <script>
        $(document).ready(function(){
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
                    $($(this).find('i:first')).removeClass('i-Arrow-Forward-2').addClass('i-Arrow-Up-2')
                    // $(this).html('<i class="i-Arrow-Up-2 t-font-boldest"></i>')
                } else {
                    $($(this).find('i:first')).removeClass('i-Arrow-Up-2').addClass('i-Arrow-Forward-2')
                    // $(this).html('<i class="i-Arrow-Down-2 t-font-boldest"></i>')
                }
            })
        })
    </script>
@endsection