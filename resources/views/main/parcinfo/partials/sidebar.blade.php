@php
    $entreprise = Auth::user()->entreprise->id ?? 1;
@endphp
<ul class="metismenu" id="menu">
    {{-- <li class="Ul_li--hover"><a href="{{ route('stock.index') }}"><i class="i-Bar-Chart text-20 mr-2 text-muted"></i><span class="item-name text-15 text-muted">Tableau de bord</span></a></li> --}}
    <li class="Ul_li--hover"><a href="{{ route('parcinfo.index') }}"><i class="i-Dashboard text-20 mr-2 text-muted"></i><span class="item-name text-15 text-muted">Tableau de bord</span></a></li>
    <li class="Ul_li--hover"><a href="{{ route('parcinfo.devices.index') }}"><i class="i-VPN text-20 mr-2 text-muted"></i><span class="item-name text-15 text-muted">Appareils</span></a></li>
    <li class="Ul_li--hover"><a href="{{ route('parcinfo.types.index') }}"><i class="i-Folder-Open text-18 mr-2 text-muted"></i><span class="item-name text-15 text-muted">Catégories</span></a></li>


    <!--  <p class="main-menu-title text-muted ml-3 font-weight-700 text-13 mt-4 mb-2">UI Elements</p> -->
</ul>
