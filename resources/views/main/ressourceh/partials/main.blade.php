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
    @include('main.ressourceh.partials.sidebar')
@endsection

@section('raccourcis')
    @include('main.ressourceh.partials.header')
@endsection

@section('content')

    @yield('content')

@endsection

@section('module_name')
   Ressources Humaines
@endsection

@section('javascripts')

    @yield('javascripts')

@endsection
