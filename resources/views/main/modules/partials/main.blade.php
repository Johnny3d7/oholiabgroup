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
    @include('main.modules.partials.sidebar')
@endsection

@section('raccourcis')
    @include('main.modules.partials.header')
@endsection

@section('content')

    @yield('content')

@endsection

@section('module_name')
    Modules
@endsection

@section('javascripts')

    @yield('javascripts')

@endsection