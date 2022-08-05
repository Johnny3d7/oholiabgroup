@extends('main.layout.main', [
    'moduleTitle' => 'Mon Compte',
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
    @include('admin.partials.sidebar_profile')
@endsection

@section('raccourcis')
    @yield('raccourcis')
@endsection

@section('content')
    @yield('content')
@endsection

@section('module_name')
    Profile
@endsection

@section('javascripts')
    @yield('javascripts')
@endsection
