@php
    $entreprise = Auth::user()->entreprise->id ?? 1;
@endphp
<ul class="metismenu" id="menu">
    {{-- <li class="Ul_li--hover"><a href="{{ route('stock.index') }}"><i class="i-Bar-Chart text-20 mr-2 text-muted"></i><span class="item-name text-15 text-muted">Tableau de bord</span></a></li> --}}

    <li class="Ul_li--hover"><a href="{{ route('admin.index') }}"><i class="i-Dashboard text-20 mr-2 text-muted"></i><span class="item-name text-15 text-muted">Tableau de bord</span></a></li>
    <li class="Ul_li--hover"><a href="{{ route('admin.entreprises.index') }}"><i class="i-Bank text-20 mr-2 text-muted"></i><span class="item-name text-15 text-muted">Entreprises</span></a></li>
    <li class="Ul_li--hover"><a href="{{ route('admin.entrepots.index') }}"><i class="i-Shop-2 text-20 mr-2 text-muted"></i><span class="item-name text-15 text-muted">Entrepots</span></a></li>
    {{-- <li class="Ul_li--hover"><a href="{{ route('admin.categories.index') }}"><i class="i-Folder-Open text-18 mr-2 text-muted"></i><span class="item-name text-15 text-muted">Categories</span></a></li> --}}
    <li class="Ul_li--hover {{-- mm-active --}}"><a class="has-arrow" href="#" aria-expanded="false"><i class="i-Bar-Chart text-20 mr-2 text-muted"></i><span class="item-name text-15 text-muted">Produits</span></a>
        <ul class="mm-collapse">
            <li class="item-name"><a href="{{ route('admin.products.index') }}"><i class="i-ID-2 mr-2 text-muted"></i><span class="text-muted">Liste</span></a></li>
            <li class="item-name"><a href="{{ route('admin.products.categories.index') }}"><i class="i-Folder-Settings mr-2 text-muted"></i><span class="text-muted">Catégories</span></a></li>
            <li class="item-name"><a href="{{ route('admin.products.types.index') }}"><i class="i-Gear mr-2 text-muted"></i><span class="text-muted">Types</span></a></li>
            <li class="item-name"><a href="{{ route('admin.products.natures.index') }}"><i class="i-Gear-2 mr-2 text-muted"></i><span class="text-muted">Natures</span></a></li>
            <li class="item-name"><a href="{{ route('admin.products.unites.index') }}"><i class="i-Data-Settings mr-2 text-muted"></i><span class="text-muted">Unités</span></a></li>
        </ul>
    </li>
    {{-- <li class="Ul_li--hover"><a href="{{ route('admin.products.index') }}"><i class="i-ID-2 text-20 mr-2 text-muted"></i><span class="item-name text-15 text-muted">Produits</span></a></li> --}}
    <li class="Ul_li--hover"><a href="{{ route('admin.employes.index') }}"><i class="i-Business-ManWoman text-16 mr-2 text-muted"></i><span class="item-name text-15 text-muted">Employés</span></a></li>
    <li class="Ul_li--hover {{-- mm-active --}}"><a class="has-arrow" href="#" aria-expanded="false"><i class="i-Truck text-20 mr-2 text-muted"></i><span class="item-name text-15 text-muted">Fournisseurs</span></a>
        <ul class="mm-collapse">
            <li class="item-name"><a href="{{ route('admin.fournisseurs.index') }}"><i class="i-ID-2 mr-2 text-muted"></i><span class="text-muted">Liste</span></a></li>
            <li class="item-name"><a href="{{ route('admin.fournisseurs.types.index') }}"><i class="i-Gear mr-2 text-muted"></i><span class="text-muted">Types</span></a></li>
        </ul>
    </li>
    <li class="Ul_li--hover"><a href="{{ route('admin.users.index') }}"><i class="i-Male-21 text-20 mr-2 text-muted"></i><span class="item-name text-15 text-muted">Utilisateurs</span></a></li>
    @can('browse users')
    <li class="Ul_li--hover"><a href="{{ route('admin.users.index') }}"><i class="i-Conference text-20 mr-2 text-muted"></i><span class="item-name text-15 text-muted">Utilisateurs</span></a></li>
    @endcan
    <li class="Ul_li--hover"><a href="{{ route('admin.roles.index') }}"><i class="i-Link text-20 mr-2 text-muted"></i><span class="item-name text-15 text-muted">Roles</span></a></li>
    <li class="Ul_li--hover"><a href="{{ route('admin.permissions.index') }}"><i class="i-Affiliate text-16 mr-2 text-muted"></i><span class="item-name text-15 text-muted">Permissions</span></a></li>
    <li class="Ul_li--hover"><a href="{{ route('admin.icons.index') }}" target="_blank"><i class="i-Environmental-3 text-20 mr-2 text-muted"></i><span class="item-name text-15 text-muted">Icons</span></a></li>
    {{-- <li class="Ul_li--hover"><a href="#"><i class="i-Building text-20 mr-2 text-muted"></i><span class="item-name text-15 text-muted">Pannes</span></a></li>
    <li class="Ul_li--hover"><a href="#"><i class="i-Building text-20 mr-2 text-muted"></i><span class="item-name text-15 text-muted">Patentes</span></a></li>
    <li class="Ul_li--hover"><a href="#"><i class="i-Building text-20 mr-2 text-muted"></i><span class="item-name text-15 text-muted">Chauffeurs</span></a></li>
    <li class="Ul_li--hover"><a href="#"><i class="i-Building text-20 mr-2 text-muted"></i><span class="item-name text-15 text-muted">Affectation</span></a></li> --}}


    <!--  <p class="main-menu-title text-muted ml-3 font-weight-700 text-13 mt-4 mb-2">UI Elements</p> -->
</ul>
