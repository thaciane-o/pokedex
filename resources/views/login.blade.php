@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/backgorund-animation.css') }}">
@endpush

@section('content')
    {{-- Background animado --}}
    <x-background-animation />
    {{-- Card de login centralizado --}}
    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="card p-4 shadow w-50" style="max-width: 500px;">
            <h2 class="text-center mb-2">Login</h2>

            {{-- Status da sessão --}}
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                {{-- Email --}}
                <div class="mb-3">
                    <label for="email" class="form-label">E-mail</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror"
                           id="email" name="email" value="{{ old('email') }}" required autofocus>
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Senha --}}
                <div class="mb-3">
                    <label for="password" class="form-label">Senha</label>
                    <input type="password" class="form-control @error('password') is-invalid @enderror"
                           id="password" name="password" required>
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Lembrar de mim --}}
                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="remember" name="remember">
                    <label class="form-check-label" for="remember">Lembrar de mim</label>
                </div>

                {{-- Links e botão --}}
                <div class="d-flex justify-content-between align-items-center mb-3">
                    @if (Route::has('password.request'))
                        <a class="text-decoration-none small text-muted" href="{{ route('password.request') }}">
                            Esqueceu a senha?
                        </a>
                    @endif

                    <a href="{{ route('register') }}" class="text-decoration-none small">Criar conta</a>
                </div>

                <div class="d-grid">
                    <button type="submit" class="btn btn-primary">Entrar</button>
                </div>
            </form>
        </div>
    </div>
@endsection
