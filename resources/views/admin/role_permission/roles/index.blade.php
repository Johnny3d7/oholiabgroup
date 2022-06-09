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
                                    <a class="nav-link active show" data-toggle="tab" href="#roles-users-{{ $role->id }}" role="tab" aria-selected="true">
                                        <i class="i-Male-21"></i>
                                        <span class="pl-1">
                                            Utilisateurs
                                        </span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#roles-permissions-{{ $role->id }}" role="tab" aria-selected="false">
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
                        <h5 class="text-center pb-1"><i class="i-Home-4"></i> Home route : <a href="{{ route($role->home()['name']) }}">{{ $role->home()['display'] }}</a>  <a href="#" title="Modifier"><i class="i-Pen-4 text-success"></i></a></h5>
                        <div class="tab-content pr-1 pt-1">
                            <div class="tab-pane active show" id="roles-users-{{ $role->id }}">
                                <div class="row">
                                    <div class="container">
                                        <span class="h5">Tous les utilisateurs</span>
                                        <a href="#" class="btn btn-outline-info float-right"><i class="i-Add-User"></i> Ajouter</a>
                                    </div>
                                </div>
                                <div class="ul-widget1 pr-3" id="collapse-icon-{{ $role->id }}">
                                    @foreach ($role->users as $user)
                                        <div class="ul-widget4__item ul-widget4__users">
                                            <div class="ul-widget4__img">
                                                <img id="userDropdown" src="{{ asset('images/faces/1.jpg') }}" alt="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            </div>
                                            <div class="ul-widget2__info ul-widget4__users-info">
                                                <a class="ul-widget2__title" href="#">{{ $user->username }}</a>
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
                                    @endforeach
                                </div>
                            </div>
                            <div class="tab-pane" id="roles-permissions-{{ $role->id }}">
                                <div class="row">
                                    <div class="container">
                                        <span class="h5">Toutes les permissions</span>
                                        <a href="#" class="btn btn-outline-info float-right"><i class="i-Add"></i> Ajouter</a>
                                    </div>
                                </div>
                                <div class="ul-widget1 pr-3">
                                    @forelse ($role->permissions as $permission)
                                        <div class="ul-widget4__item ul-widget4__users">
                                            <div class="ul-widget4__img rounded-circle border p-1">
                                                <i class="i-Affiliate text-20"></i>
                                            </div>
                                            <div class="ul-widget2__info ul-widget4__users-info">
                                                <a class="ul-widget2__title" href="#">{{ $permission->display_name }}</a>
                                                <span class="ul-widget2__username" href="#">{{ $permission->table }}</span>
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
                                    @empty
                                    <h6 class="text-center pt-5">Aucune permission n'a été attribuée !</h6>
                                    @endforelse
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
                    <a class="text-default collapseBtn" href="#collapse-icon-{{ $role->id }}" data-toggle="collapse" aria-expanded="false">
                        <i class="i-Arrow-Up-2 t-font-boldest"></i>
                    </a>
                </div>
                <div class="collapse collapse-table show" id="collapse-icon-{{ $role->id }}" style="">
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