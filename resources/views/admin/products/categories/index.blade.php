@extends('admin.partials.main')

@section('raccourcis')
    @include('admin.products.categories._header')
@endsection

@section('stylesheets')

@endsection

@section('menuTitle')
Catégories
@endsection

@section('pageTitle')
Catégories
@endsection

@section('content')
@include('admin.partials.addModal', ['type' => 'categorie', 'genre' => 'F'])
<div class="row">
    <div class="col">
        <button class="btn btn-outline-primary float-right expandAll"><i class="i-Arrow-Down-2 t-font-boldest"></i> Expand all</button>
    </div>
    <div class="col">
        <button class="btn btn-outline-primary collapseAll"><i class="i-Arrow-Up-2 t-font-boldest"></i> Collapse all</button>
    </div>
</div>
<div class="row mb-4">
    @forelse ($categories->sortBy('name') as $categorie)
        {{-- <div class="col-md-3 py-3">
            <div class="card card-body ul-border__bottom">
                <div class="text-center">
                    <i class="i-Folder-Open text-30 text-primary"></i>
                    <h5 class="heading text-primary mt-2">{{ $categorie->name }}</h5>
                    <a class="text-default collapseBtn" href="#collapse-icon-{{ $categorie->uuid }}" data-toggle="collapse" aria-expanded="false">
                        <i class="i-Arrow-Up-2 t-font-boldest"></i>
                    </a>
                </div>
                <div class="collapse collapse-table show" id="collapse-icon-{{ $categorie->uuid }}" style="">
                    <div class="mt-3">
                        <ul class="list-group">
                            @foreach ($categorie->children() as $cat)
                                <li class="list-group-item disabled">{{ $cat->name }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div> --}}


        <div class="col-md-3 py-3">
            <div class="card card-body ul-border__bottom">
                <div class="text-center">
                    <h5 class="heading text-primary">
                        <i class="i-Folder-Open"></i>
                        {{ $categorie->name }}
                        <div class="btn-group dropleft float-right">
                            <button class="btn bg-white _r_btn border-0" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                {{-- <span class="_dot _inline-dot bg-primary mr-1"></span><span class="_dot _inline-dot bg-primary mr-1"></span><span class="_dot _inline-dot bg-primary mr-1"></span> --}}
    
                                <span class="_dot _r_block-dot bg-dark"></span>
                                <span class="_dot _r_block-dot bg-dark"></span>
                                <span class="_dot _r_block-dot bg-dark"></span>
                            </button>
                            <div class="dropdown-menu dropleft" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(895px, 144px, 0px);">
                                <a class="dropdown-item ul-widget__link--font" href="" data-toggle="modal" data-target="#add_subcategorie_{{ $categorie->uuid }}_modal" style="text-decoration: none !important;"><i class="i-Add"></i> Ajouter sous-categorie</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item ul-widget__link--font" href="javascript:void()" data-toggle="modal" data-target="#rename_categorie_{{ $categorie->uuid }}_modal"><i class="i-Pen-2"> </i> Renommer</a>
                                <a class="dropdown-item ul-widget__link--font" href="javascript:void()" onclick="if(confirm('Voulez vous vraiment supprimer la catégorie {{ $categorie->name }}')) document.getElementById('deleteCategory{{ $categorie->uuid }}').submit()"><i class="i-Close"> </i> Supprimer</a>
                            </div>
                        </div>
                    </h5>
                    {{-- <p class="mb-3 text-muted">Icons in block or inline elements</p> --}}
                    <a class="text-default collapseBtn" href="#collapse-icon-{{ $categorie->uuid }}" data-toggle="collapse" aria-expanded="false">
                        <i class="i-Arrow-Up-2 t-font-boldest"></i>
                    </a>
                </div>
                <div class="collapse collapse-table show" id="collapse-icon-{{ $categorie->uuid }}" style="">
                    <div class="mt-3 border">
                        <ul class="ul-widget1 pl-3 mb-0">
                            @forelse ($categorie->categories as $subcategorie)
                                <li class="ul-widget4__item ul-widget4__users py-2 hover2display">
                                    {{ $subcategorie->name }}
                                    <div class="btn-group dropleft float-right displayHover d-none">
                                        <button class="btn bg-white _r_btn border-0" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            {{-- <span class="_dot _inline-dot bg-primary mr-1"></span><span class="_dot _inline-dot bg-primary mr-1"></span><span class="_dot _inline-dot bg-primary mr-1"></span> --}}
                
                                            <span class="_dot _r_block-dot bg-secondary" style="height: 3px; width: 3px;"></span>
                                            <span class="_dot _r_block-dot bg-secondary" style="height: 3px; width: 3px;"></span>
                                            <span class="_dot _r_block-dot bg-secondary" style="height: 3px; width: 3px;"></span>
                                        </button>
                                        <div class="dropdown-menu dropleft" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(895px, 144px, 0px);">
                                            <a class="dropdown-item ul-widget__link--font" href="javascript:void()" data-toggle="modal" data-target="#rename_categorie_{{ $subcategorie->uuid }}_modal"><i class="i-Pen-2"> </i> Renommer</a>
                                            <a class="dropdown-item ul-widget__link--font" href="javascript:void()"><i class="i-Cursor-Move-2 pr-1"></i> Déplacer</a>
                                            <a class="dropdown-item ul-widget__link--font" href="javascript:void()" onclick="if(confirm('Voulez vous vraiment supprimer la catégorie {{ $subcategorie->name }}')) document.getElementById('deleteCategory{{ $subcategorie->uuid }}').submit()"><i class="i-Close"> </i> Supprimer</a>
                                            <form id="deleteCategory{{ $subcategorie->uuid }}" action="{{ route('admin.categories.destroy', $subcategorie) }}" method="post">
                                                @csrf
                                                @method("DELETE")
                                            </form>
                                        </div>
                                    </div>
                                </li>
                                @include('admin.products.categories._renameModal', ['type' => 'sous-catégorie'])
                            @empty
                                <p class="text-center">Aucune sous-catégorie</p>
                            @endforelse
                            
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <form id="deleteCategory{{ $categorie->uuid }}" action="{{ route('admin.categories.destroy', $categorie) }}" method="post">
            @csrf
            @method("DELETE")
        </form>
        @include('admin.products.categories._addModal')
        @include('admin.products.categories._renameModal')
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
        })
    </script>
@endsection