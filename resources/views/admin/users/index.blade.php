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
                <a href="http://localhost:3000/admin/produits/create">
                    <button class="btn btn-lg btn-primary ladda-button basic-ladda-button" style="float: right" data-style="expand-right">
                        <span class="ladda-label">Ajouter un utilisateur</span>
                    </button>
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
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $id => $user)    

                                <tr>
                                    <th scope="row">{{ $id+1 }}</th>
                                    <td>{{ $user->username }}</td>
                                    <td><img class="rounded-circle m-0 avatar-sm-table" src="{{ asset($user->image()) }}" alt="" style="height: 2rem; width: 2rem;"></td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->role->name }}</td>
                                    <td><i class="i-Eyeglasses-Smiley-2"></i></td>
                                    <td><span class="badge badge-success">Active</span></td>
                                    <td>
                                        <a href="{{ route('admin.users.show', $user) }}" class="btn btn-info" type="button"><i class="nav-icon i-Eye"></i></a>
                                        <button class="btn btn-success" type="button"><i class="nav-icon i-Pen-2"></i></button>
                                        <button class="btn btn-danger" type="button"><i class="nav-icon i-Close-Window"></i></button>
                                    </td>
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