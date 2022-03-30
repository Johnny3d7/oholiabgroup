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

@php
    $icons = [
'Big-Data',
'Data-Storage',
'Data-Center',
'Data-Stream',
'Data-Backup',
'Data-Settings',
'Data-Password',
'Data-Lock',
'Data-Unlock',
'Data-Search',
'Data-Financial',
'Data-Cloud',
'Data-Block',
'Data-Refresh',
'Data-Clock',
'Data-Download',
'Data-Upload',
'Data-Yes',
'Data-Save',
'Data-Sharing',
'Data-Network',
'Data-Security',
'Data-Shield',
'Data-Transfer',
'Data-Signal',
'Data-Copy',
'Data-Compress',

'Window',
'Upload',
'Download',
'Block',
'Loading',
'Refresh',
'Lock',
'Duplicate',
'Approved',
'New-Tab',
'Love',
'Save',
'Font',
'Height',
'Width',
'Share',
'Network',
'Sidebar',
'Full-View',
'Split',
'Favorite',
'Time',
'Touch',
'Home',
'Warning',
'Error-404',
'Info',
'Code',
'Url',
'Split-Horizontal',
'Split-Vertical',
'Split-Vertical',
'Split-4---Square',
'Minimaze-Maximize',
'Close',
'One-Window',
'Close',
'Maximize',
'Minimize',
'Restore',
'Split-Horizontal-2',
'Navigation',
'Right',
'Navigation',
'Left',
    ]
@endphp

@section('content')
    <div class="container-fluid">
        <div class="row">
            @foreach ($icons as $icon)
                <div class="col-md-1 p-3 m-1 text-center rounded border">
                    <i class="i-{{ $icon }} text-50 mr-2 text-muted"></i> <br>
                    <span>{{ $icon }}</span>
                </div>
            @endforeach
        </div>
    </div>
@endsection

@section('javascripts')

@endsection