@props(['id'            => '',
        'href'          => '#',
        'hint'          => 'Criar novo registro',
        'class'         => '',
        'text'         => '',
        'icon'         => ''])

<a href="{{ $href }}" class="d-sm-inline-block prevent2Click {{ $class }}" {{ $attributes }} id="{{$id}}" title="{{ $hint }}" data-bs-placement="top" data-bs-toggle="tooltip" data-bs-trigger="hover">
    <span class="spinner-border spinner-border-sm me-2 d-none" role="status" aria-hidden="true" ></span>
    <i class="{{ $icon }}"></i> {{ $text }}
</a>