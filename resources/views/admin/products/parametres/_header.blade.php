<a href="javascript:void(0);
" class="mr-3" data-toggle="modal" data-target="#add_{{ $type }}_modal" style="text-decoration: none !important;">
    <i class="i-Add text-20 cursor-pointer" data-toggle="tooltip" data-placement="top" title="" data-original-title="Créer un{{ $type != 'type' ? 'e' : '' }} {{ $type }}"></i>
</a>
<a href="{{ route('admin.'.$type.'s.index') }}" class="mr-3">
    <i class="i-Check text-20 cursor-pointer" data-toggle="tooltip" data-placement="top" title="" data-original-title="Liste des {{ $type }}s"></i>
</a>