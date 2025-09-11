@extends('layouts.dashboard')
@section('title', 'Pokémon')
@section('title-actions')
    <x-tabler.btn href="{{ route('pokemon.create') }}" icon="ti ti-plus" class="btn btn-primary" text="Novo" hint="Cadastrar novo Pokémon" />
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