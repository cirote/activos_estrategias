<li class="header">ESTRATEGIAS</li>
<li class="{{ Request::routeIs('estrategias.bases.nuevas') ? "active" : "" }}">
    <a href="{{ route('estrategias.bases.nuevas', [], false) }}">
        <i class="fa fa-eraser"></i> <span>Limpiar cache</span>
    </a>
</li>
<li class="{{ Request::routeIs('estrategias.bases') ? "active" : "" }}">
    <a href="{{ route('estrategias.bases', [], false) }}">
        <i class="fa fa-flag-o"></i> <span>Bases</span>
    </a>
</li>
<li class="{{ Request::routeIs('estrategias.spreads') ? "active" : "" }}">
    <a href="{{ route('estrategias.spreads', [], false) }}">
        <i class="fa fa-arrows-h"></i> <span>Spreads</span>
    </a>
</li>
<li class="{{ Request::routeIs('estrategias.lanzamiento_cubierto') ? "active" : "" }}">
    <a href="{{ route('estrategias.lanzamiento_cubierto', [], false) }}">
        <i class="fa fa-rocket"></i> <span>Lanzamiento cubierto</span>
    </a>
</li>
<li class="{{ Request::routeIs('estrategias.tester') ? "active" : "" }}">
    <a href="{{ route('estrategias.tester', [], false) }}">
        <i class="fa fa-rocket"></i> <span>Tester</span>
    </a>
</li>
