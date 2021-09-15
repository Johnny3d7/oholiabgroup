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
    @include('main.parcauto.partials.sidebar')
@endsection

@section('raccourcis')
    @include('main.parcauto.partials.header')
@endsection

@section('content')

    @yield('content')

@endsection

@section('module_name')
    Parc automobile
@endsection

@section('javascripts')

    @yield('javascripts')

@endsection