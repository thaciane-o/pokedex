@extends('layouts.app')

@section('content')
    <x-layouts.dashboard :title="View::getSection('title')">
    <div class="d-flex justify-content-end mx-3">
    </div>
    <div class="d-flex justify-content-center aling-items-center">
        <div class="p-3 card w-75">
            <livewire:pokemons>
        </div>
    </div>
    </x-layouts.dashboard>
@endsection

@push('scripts')

@endpush
