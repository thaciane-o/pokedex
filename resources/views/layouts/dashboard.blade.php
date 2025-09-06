@extends('layouts.app')

@section('content')
    <x-layouts.dashboard :title="View::getSection('title')">
        @yield('main')
    </x-layouts.dashboard>
@endsection
