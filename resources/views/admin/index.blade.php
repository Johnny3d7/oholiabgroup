@extends('admin.partials.main')

@section('raccourcis')
    @include('admin.partials.header')
@endsection

@section('stylesheets')

@endsection

@section('menuTitle')
Administration
@endsection

@section('pageTitle')
Administration
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-6 col-md-12">
            <!-- CARD ICON-->
            <div class="row">
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="card card-icon mb-4">
                        <div class="card-body text-center"><i class="i-Data-Upload"></i>
                            <p class="text-muted mt-2 mb-2">Today's Upload</p>
                            <p class="text-primary text-24 line-height-1 m-0">21</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="card card-icon mb-4">
                        <div class="card-body text-center"><i class="i-Add-User"></i>
                            <p class="text-muted mt-2 mb-2">New Users</p>
                            <p class="text-primary text-24 line-height-1 m-0">21</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="card card-icon mb-4">
                        <div class="card-body text-center"><i class="i-Money-2"></i>
                            <p class="text-muted mt-2 mb-2">Total sales</p>
                            <p class="text-primary text-24 line-height-1 m-0">4021</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="card card-icon-big mb-4">
                        <div class="card-body text-center"><i class="i-Money-2"></i>
                            <p class="line-height-1 text-title text-18 mt-2 mb-0">4021</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="card card-icon-big mb-4">
                        <div class="card-body text-center"><i class="i-Gear"></i>
                            <p class="line-height-1 text-title text-18 mt-2 mb-0">4021</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="card card-icon-big mb-4">
                        <div class="card-body text-center"><i class="i-Bell"></i>
                            <p class="line-height-1 text-title text-18 mt-2 mb-0">4021</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card o-hidden mb-4">
                <div class="card-header d-flex align-items-center">
                    <h3 class="w-50 float-left card-title m-0">New Users</h3>
                    <div class="dropdown dropleft text-right w-50 float-right">
                        <button class="btn bg-gray-100" id="dropdownMenuButton_table1" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="nav-icon i-Gear-2"></i></button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton_table1" x-placement="left-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(331px, 0px, 0px);"><a class="dropdown-item" href="#">Add new user</a><a class="dropdown-item" href="#">View All users</a><a class="dropdown-item" href="#">Something else here</a></div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <div id="user_table_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4 no-footer"><div class="row"><div class="col-sm-12 col-md-6"><div class="dataTables_length" id="user_table_length"><label>Show <select name="user_table_length" aria-controls="user_table" class="form-control form-control-sm"><option value="10">10</option><option value="25">25</option><option value="50">50</option><option value="100">100</option></select> entries</label></div></div><div class="col-sm-12 col-md-6"><div id="user_table_filter" class="dataTables_filter"><label>Search:<input type="search" class="form-control form-control-sm" placeholder="" aria-controls="user_table"></label></div></div></div><div class="row"><div class="col-sm-12"><table class="table dataTable-collapse text-center dataTable no-footer" id="user_table" role="grid" aria-describedby="user_table_info">
                            <thead>
                                <tr role="row"><th scope="col" class="sorting" tabindex="0" aria-controls="user_table" rowspan="1" colspan="1" style="width: 25.6833px;" aria-label="#: activate to sort column ascending">#</th><th scope="col" class="sorting" tabindex="0" aria-controls="user_table" rowspan="1" colspan="1" style="width: 99.467px;" aria-label="Name: activate to sort column ascending">Name</th><th scope="col" class="sorting" tabindex="0" aria-controls="user_table" rowspan="1" colspan="1" style="width: 78.383px;" aria-label="Avatar: activate to sort column ascending">Avatar</th><th scope="col" class="sorting_desc" tabindex="0" aria-controls="user_table" rowspan="1" colspan="1" style="width: 184.217px;" aria-label="Email: activate to sort column ascending" aria-sort="descending">Email</th><th scope="col" class="sorting" tabindex="0" aria-controls="user_table" rowspan="1" colspan="1" style="width: 102.267px;" aria-label="Status: activate to sort column ascending">Status</th><th scope="col" class="sorting" tabindex="0" aria-controls="user_table" rowspan="1" colspan="1" style="width: 80.483px;" aria-label="Action: activate to sort column ascending">Action</th></tr>
                            </thead>
                            <tbody>
                                <tr role="row" class="odd">
                                    <th scope="row" class="">1</th>
                                    <td>Smith</td>
                                    <td><img class="rounded-circle m-0 avatar-sm-table" src="../../dist-assets/images/faces/1.jpg" alt=""></td>
                                    <td class="sorting_1">Smith@gmail.com</td>
                                    <td><span class="badge badge-success">Active</span></td>
                                    <td><a class="text-success mr-2" href="#"><i class="nav-icon i-Pen-2 font-weight-bold"></i></a><a class="text-danger mr-2" href="#"><i class="nav-icon i-Close-Window font-weight-bold"></i></a></td>
                                </tr>
                                <tr role="row" class="even">
                                    <th scope="row" class="">3</th>
                                    <td>Alex</td>
                                    <td><img class="rounded-circle m-0 avatar-sm-table" src="../../dist-assets/images/faces/1.jpg" alt=""></td>
                                    <td class="sorting_1">Otto@gmail.com</td>
                                    <td><span class="badge badge-warning">Not Active</span></td>
                                    <td><a class="text-success mr-2" href="#"><i class="nav-icon i-Pen-2 font-weight-bold"></i></a><a class="text-danger mr-2" href="#"><i class="nav-icon i-Close-Window font-weight-bold"></i></a></td>
                                </tr>
                                <tr role="row" class="odd">
                                    <th scope="row" class="">2</th>
                                    <td>Jhon Doe</td>
                                    <td><img class="rounded-circle m-0 avatar-sm-table" src="../../dist-assets/images/faces/1.jpg" alt=""></td>
                                    <td class="sorting_1">Jhon@gmail.com</td>
                                    <td><span class="badge badge-info">Pending</span></td>
                                    <td><a class="text-success mr-2" href="#"><i class="nav-icon i-Pen-2 font-weight-bold"></i></a><a class="text-danger mr-2" href="#"><i class="nav-icon i-Close-Window font-weight-bold"></i></a></td>
                                </tr>
                            </tbody>
                        </table></div></div><div class="row"><div class="col-sm-12 col-md-5"><div class="dataTables_info" id="user_table_info" role="status" aria-live="polite">Showing 1 to 3 of 3 entries</div></div><div class="col-sm-12 col-md-7"><div class="dataTables_paginate paging_simple_numbers" id="user_table_paginate"><ul class="pagination"><li class="paginate_button page-item previous disabled" id="user_table_previous"><a href="#" aria-controls="user_table" data-dt-idx="0" tabindex="0" class="page-link">Previous</a></li><li class="paginate_button page-item active"><a href="#" aria-controls="user_table" data-dt-idx="1" tabindex="0" class="page-link">1</a></li><li class="paginate_button page-item next disabled" id="user_table_next"><a href="#" aria-controls="user_table" data-dt-idx="2" tabindex="0" class="page-link">Next</a></li></ul></div></div></div></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('javascripts')

@endsection