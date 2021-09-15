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
    @include('main.parcinfo.partials.sidebar')
@endsection

@section('raccourcis')
    @include('main.parcinfo.partials.header')
@endsection

@section('content')

    @yield('content')

@endsection

@section('module_name')
    Parc Informatique
@endsection

@section('javascripts')

    @yield('javascripts')

@endsection
