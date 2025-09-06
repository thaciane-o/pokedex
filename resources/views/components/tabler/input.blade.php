@props([
    'label' => null,
    'name' => null,
    'id' => null,
    'required' => false,
    'type' => 'text'
 ])

@php
    $inputId = $id ?? $name;
@endphp

<div class="mb-3">
    @if ($label && $name)
        <label for="{{ $inputId }}" class="form-label">
            {{ $label }} @if($required) <span class="text-danger">*</span> @endif
        </label>
    @endif

    <input
        type="{{$type}}"
        name="{{ $name }}"
        id="{{ $inputId }}"
        {{ $required ? 'required' : '' }}
        {{ $attributes->merge(['class' => 'form-control' . ($errors->has($name) ? ' is-invalid' : '')]) }}

    >

    @error($name)
        <span class="alert alert-danger mt-2 py-1 px-2 d-block" role="alert">
            {{ $message }}
        </span>
    @enderror
</div>
