@php
    $entreprise = Auth::user()->entreprise->id;
@endphp
<ul class="metismenu" id="menu">
    {{-- <li class="Ul_li--hover"><a href="{{ route('stock.index') }}"><i class="i-Bar-Chart text-20 mr-2 text-muted"></i><span class="item-name text-15 text-muted">Tableau de bord</span></a></li> --}}
    <li class="Ul_li--hover"><a href="#"><i class="i-Building text-20 mr-2 text-muted"></i><span class="item-name text-15 text-muted">Tableau de bord</span></a></li>
    <li class="Ul_li--hover"><a href="#"><i class="i-Building text-20 mr-2 text-muted"></i><span class="item-name text-15 text-muted">Equipements</span></a></li>
    <li class="Ul_li--hover"><a href="#"><i class="i-Building text-20 mr-2 text-muted"></i><span class="item-name text-15 text-muted">Tickets maintenances</span></a></li>
    <li class="Ul_li--hover"><a href="#"><i class="i-Building text-20 mr-2 text-muted"></i><span class="item-name text-15 text-muted">Attributions</span></a></li>
    

    <!--  <p class="main-menu-title text-muted ml-3 font-weight-700 text-13 mt-4 mb-2">UI Elements</p> -->
</ul>
