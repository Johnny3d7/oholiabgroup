@php
    $genre = $type == "type" ? 'M' : ($type == "unite" ? 'Fa' : 'F');
    $icon = $type == "type" ? 'i-Gear' : ($type == "unite" ? 'i-Data-Settings' : ($type == "nature" ? 'i-Gear-2 ' : ''));
    $model = $model ?? '';
@endphp
@extends('admin.partials.main')

@section('raccourcis')
    @include('admin.parametres._header')
@endsection

@section('stylesheets')

@endsection

@section('menuTitle')
{{ ucfirst($type) }}s
@endsection

@section('pageTitle')
{{ ucfirst($type) }}s
@endsection

@section('content')
@include('admin.partials.addModal', ['type' => $type, 'genre' => $genre, 'model' => $model])
<div class="row">
    <div class="col">
        <button class="btn btn-outline-primary float-right expandAll"><i class="i-Arrow-Down-2 t-font-boldest"></i> Expand all</button>
    </div>
    <div class="col">
        <button class="btn btn-outline-primary collapseAll"><i class="i-Arrow-Up-2 t-font-boldest"></i> Collapse all</button>
    </div>
</div>
<div class="row mb-4">
    @forelse ($parametres->sortBy('name') as $parametre)
        <div class="col-md-3 py-3">
            <div class="card card-body ul-border__bottom">
                <div class="text-center">
                    <h5 class="heading text-primary">
                        <i class="{{ $icon }}"></i>
                        {{ $parametre->name }}
                        <div class="btn-group dropleft float-right">
                            <button class="btn bg-white _r_btn border-0" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="_dot _r_block-dot bg-dark"></span>
                                <span class="_dot _r_block-dot bg-dark"></span>
                                <span class="_dot _r_block-dot bg-dark"></span>
                            </button>
                            <div class="dropdown-menu dropleft" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(895px, 144px, 0px);">
                                <a class="dropdown-item ul-widget__link--font" href="javascript:void(0);
" data-toggle="modal" data-target="#rename_{{ $type }}_{{ $parametre->uuid }}_modal"><i class="i-Pen-2"> </i> Renommer</a>
                                <a class="dropdown-item ul-widget__link--font" href="javascript:void(0);
" onclick="if(confirm('Voulez vous vraiment supprimer {{ $type == 'type' ? 'le ' : ($type == 'unite' ? 'l`' : 'la ') }}{{ $type }} {{ $parametre->name }}')) document.getElementById('delete_{{ $type }}_{{ $parametre->uuid }}').submit()"><i class="i-Close"> </i> Supprimer</a>
                            </div>
                        </div>
                    </h5>
                    {{-- <p class="mb-3 text-muted">Icons in block or inline elements</p> --}}
                </div>
            </div>
        </div>
        <form id="delete_{{ $type }}_{{ $parametre->uuid }}" action="{{ route('admin.'.$model.$type.'s.destroy', $parametre) }}" method="post">
            @csrf
            @method("DELETE")
        </form>
        @include('admin.parametres._renameModal')
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
