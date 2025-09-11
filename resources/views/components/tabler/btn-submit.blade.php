@props(['id'    => '',
        'form'  => 'formulario',
        'hint'  => 'Salvar novo registro',
        'text'  => 'Salvar',
        'class'         => '',
        'icon' => ''])

<button type="submit" class="btn btn-outline-primary d-sm-inline-block prevent2Click {{$class}}" form="{{$form}}"
        {{ $attributes }} id="{{$id}}" title="{{$hint}}" data-bs-toggle="tooltip" data-bs-trigger="hover"
        data-bs-placement="top">
    <span class="spinner-border spinner-border-sm me-2 d-none" role="status" aria-hidden="true"></span>
    <i class="{{ $icon }}"></i> {{ $text }}
</button>
