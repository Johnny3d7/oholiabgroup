@extends('admin.partials.main')

@section('raccourcis')
    @include('admin.entreprises._header')
@endsection

@section('stylesheets')

@endsection

@section('menuTitle')
Entreprises
@endsection

@section('pageTitle')
Entreprises
@endsection

@section('content')
{{-- @include('admin.partials.addModal', ['type' => 'role']) --}}
<div class="row">
    <div class="col">
        <button class="btn btn-outline-primary float-right expandAll"><i class="i-Arrow-Down-2 t-font-boldest"></i> Expand all</button>
    </div>
    <div class="col">
        <button class="btn btn-outline-primary collapseAll"><i class="i-Arrow-Up-2 t-font-boldest"></i> Collapse all</button>
    </div>
</div>
<div class="row mb-4">
    @forelse ($entreprises->sortBy('name') as $entreprise)
        <div class="col-md-4 py-3">
            <div class="card card-body ul-border__bottom">
                <div class="text-center">
                    {{-- <img class="w-25" src="{{ url('images/logo.png') }}" alt="alt" /> --}}
                    {{-- <img class="w-25" src="{{ url('images/faviconobp.png') }}" alt="alt" /> --}}
                    {{-- <img class="w-25" src="{{ url('images/logoakebie1.png') }}" alt="alt" /> --}}
                    <img class="w-25" src="{{ asset($entreprise->logo) }}" alt="logo" />
                    <h5 class="heading text-primary pt-3">{{ $entreprise->name }}</h5>
                    {{-- <p class="mb-3 text-muted">Icons in block or inline elements</p> --}}
                    <a class="text-default collapseBtn" href="#collapse-icon-{{ $entreprise->uuid }}" data-toggle="collapse" aria-expanded="false">
                        <i class="i-Arrow-Up-2 t-font-boldest"></i>
                    </a>
                </div>
                <div class="collapse collapse-table show" id="collapse-icon-{{ $entreprise->uuid }}" style="">
                    <div class="mt-3">
                        <ul class="list-group">
                            {{-- @foreach ($entreprise->permissions as $perm)
                                <li class="list-group-item disabled">{{ $perm->display_name }}</li>
                            @endforeach --}}
                            
                        </ul>
                    </div>
                </div>
            </div>
        </div>
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