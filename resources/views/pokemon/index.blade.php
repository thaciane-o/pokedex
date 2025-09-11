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

@section('main')

@foreach ($pokemons as $pokemon)
    <p>{{ $pokemon->nome }}</p>
    <p>{{ $pokemon->tipo }}</p>
    <img class="img-fluid" src="{{ $pokemon->foto }}" alt="{{ $pokemon->nome }}">
    <a class="btn btn-primary" href="{{ route('pokemon.edit', encrypt($pokemon->id)) }}">Editar</a>
    <form method="POST" action="{{route('pokemon.destroy', encrypt($pokemon->id))}}">
        @csrf
        @method('DELETE')
        <button class="btn btn-danger">Excluir</button>
    </form>
@endforeach

@endsection
