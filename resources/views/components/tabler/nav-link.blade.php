@props(['icon', 'label', 'route', 'active'])
<li class="nav-item {{ $active }}">
    <a class="nav-link" href="{{$route}}">
            <i class="{{$icon}} me-2"></i>

        <span class="nav-link-title"> {{$label}} </span>
    </a>
</li>
