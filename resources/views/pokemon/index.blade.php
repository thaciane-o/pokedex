@extends('layouts.dashboard')
@section('title', 'Pokémon')
@section('title-actions')
    <x-tabler.btn href="{{ route('pokemon.create') }}" icon="ti ti-plus" class="btn btn-primary" hint="Cadastrar novo Pokémon" />
@endsection