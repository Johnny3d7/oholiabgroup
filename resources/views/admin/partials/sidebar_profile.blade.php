@php
    $entreprise = Auth::user()->entreprise->id ?? 1;
@endphp
<ul class="metismenu" id="menu">
    @if (\Auth::user()->home())
        <li><a class="Ul_li--hover" href="{{ route(\Auth::user()->home()['name']) }}"><i class="i-Home-4 text-20 mr-2 text-muted"></i><span class="item-name text-15 text-muted">Accueil</span></a></li>
    @endif
    <li class="Ul_li--hover"><a href="{{ route('profile.index') }}"><i class="i-{{ !$user->isEmploye() ? 'M' : ($user->employe->civilite == 'M' ? 'M' : 'Fem') }}ale-21 text-20 mr-2 text-muted"></i><span class="item-name text-15 text-muted">Mon Compte</span></a></li>
    <li class="Ul_li--hover"><a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="i-Close text-20 mr-2 text-muted"></i><span class="item-name text-15 text-muted">Déconnexion</span></a></li>
</ul>
