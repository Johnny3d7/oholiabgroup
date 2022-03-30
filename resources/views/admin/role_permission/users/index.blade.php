@extends('admin.partials.main')

@section('raccourcis')
    @include('admin.role_permission.users._header')
@endsection

@section('stylesheets')

@endsection

@section('menuTitle')
Utilisateurs
@endsection

@section('pageTitle')
Utilisateurs
@endsection

@section('content')
<div class="row mb-4">
    @foreach ($users as $user)    
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <div class="user-profile mb-4">
                        <div class="ul-widget-card__user-info"><img class="profile-picture avatar-lg mb-2" src="../../dist-assets/images/faces/1.jpg" alt="">
                            <p class="m-0 text-24">{{ $user->username }}</p>
                            {{-- <p class="text-muted m-0">{{ $user->entreprise->nom }}</p> --}}
                        </div>
                    </div>
                    <div class="ul-widget-card--line mt-2">
                        <button class="btn btn-primary ul-btn-raised--v2 m-1" type="button">Download</button>
                        <button class="btn btn-outline-success ul-btn-raised--v2 m-1 float-right" type="button">Preview</button>
                    </div>
                    <div class="ul-widget-card__rate-icon"><span><i class="i-Add-UserStar text-warning"></i> 5.0</span><span><i class="i-Bag text-primary"></i> 78 Projects</span></div>
                </div>
            </div>
        </div>
    @endforeach
</div>
@endsection

@section('javascripts')

@endsection