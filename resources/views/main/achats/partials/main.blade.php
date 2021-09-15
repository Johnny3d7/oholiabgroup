@extends('main.layout.main')

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
    @include('main.achats.partials.sidebar')
@endsection

@section('raccourcis')
    @include('main.achats.partials.header')
@endsection

@section('content')

    @yield('content')

@endsection

@section('module_name')
    Gestion des achats
@endsection

@section('javascripts')

    @yield('javascripts')

@endsection
