@extends('main.layout.main', [
    'moduleTitle' => 'Administration',
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
    @include('admin.partials.sidebar')
@endsection

@section('raccourcis')
    @yield('raccourcis')
@endsection

@section('content')

    @yield('content')

    @include('admin.partials.addModal', ['type' => 'role'])
    @include('admin.partials.addModal', ['type' => 'permission'])
@endsection

@section('module_name')
    Role & Permission
@endsection

@section('javascripts')

    @yield('javascripts')

@endsection