@php
    $entreprise = Auth::user()->entreprise->id;
@endphp
<ul class="metismenu" id="menu">
    {{-- <li class="Ul_li--hover"><a href="{{ route('stock.index') }}"><i class="i-Bar-Chart text-20 mr-2 text-muted"></i><span class="item-name text-15 text-muted">Tableau de bord</span></a></li> --}}

    <li class="Ul_li--hover"><a href="#"><i class="i-Building text-20 mr-2 text-muted"></i><span class="item-name text-15 text-muted">Véhicules</span></a></li>
    <li class="Ul_li--hover"><a href="#"><i class="i-Building text-20 mr-2 text-muted"></i><span class="item-name text-15 text-muted">Assurances</span></a></li>
    <li class="Ul_li--hover"><a href="#"><i class="i-Building text-20 mr-2 text-muted"></i><span class="item-name text-15 text-muted">Visite Technique</span></a></li>
    <li class="Ul_li--hover"><a href="#"><i class="i-Building text-20 mr-2 text-muted"></i><span class="item-name text-15 text-muted">Pannes</span></a></li>
    <li class="Ul_li--hover"><a href="#"><i class="i-Building text-20 mr-2 text-muted"></i><span class="item-name text-15 text-muted">Patentes</span></a></li>
    <li class="Ul_li--hover"><a href="#"><i class="i-Building text-20 mr-2 text-muted"></i><span class="item-name text-15 text-muted">Chauffeurs</span></a></li>
    <li class="Ul_li--hover"><a href="#"><i class="i-Building text-20 mr-2 text-muted"></i><span class="item-name text-15 text-muted">Affectation</span></a></li>


    <!--  <p class="main-menu-title text-muted ml-3 font-weight-700 text-13 mt-4 mb-2">UI Elements</p> -->
</ul>
