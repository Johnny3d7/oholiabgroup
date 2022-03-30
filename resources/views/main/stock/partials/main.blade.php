@extends('main.layout.main', [
    'moduleTitle' => 'Stock',
])

@section('stylesheets')

    @yield('stylesheets')

@endsection

@section('menuTitle')

    @yield('menuTitle')

@endsection

@section('pageTitle')

    @yield('pageTitle')

@endsection

@section('module_sidebar')
    @include('main.stock.partials.sidebar')
@endsection

@section('raccourcis')
    @include('main.stock.partials.header')
@endsection

@section('content')

    @yield('content')

@endsection

@section('module_name')
    Gestion des stocks
@endsection

@section('javascripts')

    @yield('javascripts')

@endsection