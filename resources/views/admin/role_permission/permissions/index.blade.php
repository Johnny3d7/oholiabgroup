@extends('admin.partials.main')

@section('raccourcis')
    @include('admin.role_permission.permissions._header')
@endsection

@section('stylesheets')

@endsection

@section('menuTitle')
Permissions
@endsection

@section('pageTitle')
Permissions
@endsection

@section('content')
@include('admin.partials.addModal', ['type' => 'permission', 'genre' => 'F'])
<div class="row">
    <div class="col">
        <button class="btn btn-outline-primary float-right expandAll"><i class="i-Arrow-Down-2 t-font-boldest"></i> Expand all</button>
    </div>
    <div class="col">
        <button class="btn btn-outline-primary collapseAll"><i class="i-Arrow-Up-2 t-font-boldest"></i> Collapse all</button>
    </div>
</div>
<div class="row mb-4">
    @forelse ($permissions->groupBy('table') as $table => $perms)
        <div class="col-md-3 py-3">
            <div class="card card-body ul-border__bottom">
                <div class="text-center">
                    <h5 class="heading text-primary">
                        <i class="i-Folder-Open"></i>
                        {{ $table }}
                        <div class="btn-group dropleft float-right">
                            <button class="btn bg-white _r_btn border-0" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                {{-- <span class="_dot _inline-dot bg-primary mr-1"></span><span class="_dot _inline-dot bg-primary mr-1"></span><span class="_dot _inline-dot bg-primary mr-1"></span> --}}
    
                                <span class="_dot _r_block-dot bg-dark"></span>
                                <span class="_dot _r_block-dot bg-dark"></span>
                                <span class="_dot _r_block-dot bg-dark"></span>
                            </button>
                            <div class="dropdown-menu dropleft" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(895px, 144px, 0px);">
                                <a class="dropdown-item ul-widget__link--font" href="" data-toggle="modal" data-target="#add_permission_{{ $table }}_modal" style="text-decoration: none !important;"><i class="i-Add"></i> Ajouter</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item ul-widget__link--font" href="#"><i class="i-Folder-Download"></i> Update</a>
                                <a class="dropdown-item ul-widget__link--font" href="#"><i class="i-Gears-2"></i> Customize</a>
                            </div>
                        </div>
                    </h5>
                    {{-- <p class="mb-3 text-muted">Icons in block or inline elements</p> --}}
                    <a class="text-default collapseBtn" href="#collapse-icon-{{ $table }}" data-toggle="collapse" aria-expanded="false">
                        <i class="i-Arrow-Up-2 t-font-boldest"></i>
                    </a>
                </div>
                <div class="collapse collapse-table show" id="collapse-icon-{{ $table }}" style="">
                    <div class="mt-3 border">
                        <ul class="ul-widget1 pl-3 mb-0">
                            @foreach ($perms->sortBy('display_name') as $perm)
                                <li class="ul-widget4__item ul-widget4__users py-2 hover2display">
                                    {{ $perm->display_name }}
                                    <div class="btn-group dropleft float-right displayHover d-none">
                                        <button class="btn bg-white _r_btn border-0" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            {{-- <span class="_dot _inline-dot bg-primary mr-1"></span><span class="_dot _inline-dot bg-primary mr-1"></span><span class="_dot _inline-dot bg-primary mr-1"></span> --}}
                
                                            <span class="_dot _r_block-dot bg-secondary" style="height: 3px; width: 3px;"></span>
                                            <span class="_dot _r_block-dot bg-secondary" style="height: 3px; width: 3px;"></span>
                                            <span class="_dot _r_block-dot bg-secondary" style="height: 3px; width: 3px;"></span>
                                        </button>
                                        <div class="dropdown-menu dropleft" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(895px, 144px, 0px);">
                                            <a class="dropdown-item ul-widget__link--font" href="#"><i class="i-Pen-2"> </i> Editer</a>
                                            <a class="dropdown-item ul-widget__link--font" href="#"><i class="i-Cursor-Move-2 pr-1"></i> Déplacer</a>
                                            <a class="dropdown-item ul-widget__link--font" href="#"><i class="i-Folder pr-1"></i> Dupliquer</a>
                                            <a class="dropdown-item ul-widget__link--font" href="#"><i class="i-Close"> </i> Supprimer</a>
                                            
                                        </div>
                                    </div>
                                </li>
                                
                            @endforeach
                            
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        @include('admin.role_permission.permissions._addModal')
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
        })
    </script>
@endsection