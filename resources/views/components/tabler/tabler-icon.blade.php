@props(['name', 'class' => ''])

<svg xmlns="http://www.w3.org/2000/svg"
     class="icon icon-tabler icon-tabler-{{ $name }} {{ $class }}"
     width="20"
     height="20"
     viewBox="0 0 24 24"
     stroke-width="2"
     stroke="currentColor"
     fill="none"
     stroke-linecap="round"
     stroke-linejoin="round">
    <use xlink:href="/tabler-sprite.svg#tabler-{{ $name }}" />
</svg>
