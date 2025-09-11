@extends('layouts.dashboard')
@section('title', 'Pokémon')
@section('title-actions')
    <x-tabler.btn href="{{ route('pokemon.create') }}" icon="ti ti-plus" class="btn btn-primary" text="Novo" hint="Cadastrar novo Pokémon" />
@endsection


@section('main')

@foreach ($pokemons as $pokemon)
    <div class="card mb-3">
        <div class="card-body d-flex align-items-center">
            <img src="{{ $pokemon->foto }}" alt="{{ $pokemon->name }}" class="me-3" style="width: 64px; height: 64px;">
            <div class="flex-grow-1">
                <h5 class="card-title mb-1">{{ $pokemon->nome }}</h5>
                <p class="card-text mb-0">Tipo: {{ $pokemon->tipo }}</p>
            </div>
            <a href="{{ route('pokemon.edit', encrypt($pokemon->id)) }}" class="btn btn-sm btn-secondary">Editar</a>
            <form action="{{ route('pokemon.destroy', encrypt($pokemon->id)) }}" method="POST" class="d-inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-sm btn-danger">Deletar</button>
            </form>
        </div>
    </div>
@endforeach

@endsection