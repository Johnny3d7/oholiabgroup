@extends('admin.partials.main')

@section('raccourcis')
    @include('admin.users._header')
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
<div class="row">
    <div class="container-fluid">

        <div class="card text-left">
            
            <div class="card-body">
                <a href="{{ route('admin.users.create') }}" class="btn btn-lg btn-primary ladda-button basic-ladda-button" style="float: right" data-style="expand-right">
                    <span class="ladda-label">Ajouter un utilisateur</span>
                </a>
                <div class="table-responsive">
                    <table class="table table-hover table-striped table-bordered table_oholiab">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Avatar</th>
                                <th scope="col">Email</th>
                                <th scope="col">Rôle</th>
                                <th scope="col">Employé</th>
                                <th scope="col">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $id => $user)    
                                <tr class="tr-link" data-link="{{ route('admin.users.show',$user) }}">
                                    <th scope="row">{{ $id+1 }}</th>
                                    <td>{{ $user->username }}</td>
                                    <td><img class="rounded-circle m-0 avatar-sm-table" src="{{ asset($user->image()) }}" alt="" style="height: 2rem; width: 2rem;"></td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->role->name }}</td>
                                    <td><i class="i-Eyeglasses-Smiley-2"></i></td>
                                    <td><span class="badge badge-success">Active</span></td>
                                </tr>
                            @endforeach                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>




    </div>
</div>
@endsection

@section('javascripts')

@endsection