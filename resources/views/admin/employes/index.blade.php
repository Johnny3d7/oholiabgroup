@extends('admin.partials.main')

@section('raccourcis')
    @include('admin.employes._header')
@endsection

@section('stylesheets')

@endsection

@section('menuTitle')
Employés
@endsection

@section('pageTitle')
Employés
@endsection

@section('content')
<div class="row">
    <div class="container-fluid">
        <div class="card text-left">
            <div class="card-body">
                <a href="{{ route('admin.employes.create') }}">
                    <button class="btn btn-lg btn-primary ladda-button basic-ladda-button" style="float: right" data-style="expand-right">
                        <span class="ladda-label">Ajouter un employé</span>
                    </button>
                </a>
                <div class="table-responsive">
                    <table class="table table-hover table-striped table-bordered table_oholiab">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Civilité</th>
                                <th scope="col">Nom</th>
                                <th scope="col">Prénoms</th>
                                <th scope="col">Avatar</th>
                                <th scope="col">Email</th>
                                <th scope="col">Rôle</th>
                                <th scope="col">Employé</th>
                                <th scope="col">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($employes as $id => $employe)
                                <tr class="tr-link" data-link="{{ route('admin.employes.show', $employe) }}">
                                    <th scope="row">{{ $id+1 }}</th>
                                    <td>{{ $employe->civilite }}</td>
                                    <td>{{ $employe->nom }}</td>
                                    <td>{{ $employe->prenoms }}</td>
                                    <td class="text-center">
                                        @if ($employe->user)
                                            <a href="{{ route('admin.users.show', $employe->user) }}"><img class="rounded-circle m-0 avatar-sm-table" src="{{ asset($employe->user->image()) }}" alt="" style="height: 2rem; width: 2rem;"></a>
                                        @else
                                            <i class="i-{{ $employe->civilite == 'M' ? 'M' : 'Fem' }}ale-21 text-30"></i>
                                        @endif
                                    </td>
                                    <td>{{ $employe->email }}</td>
                                    <td></td>
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
