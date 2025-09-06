@extends('layouts.dashboard')
@section('title', $funcionario->nome)

@section('main')
    <div class="d-flex justify-content-end align-items-center mb-4">
        <div>
            <a class="btn btn-outline-secondary me-2" href="{{ route('funcionario.index') }}">
                <i class="ti ti-arrow-left me-1"></i> Voltar
            </a>
            <a class="btn btn-outline-primary me-2" href="{{ route('funcionario.edit', $funcionario->id) }}">
                <i class="ti ti-device-floppy me-1"></i> Editar
            </a>
        </div>
    </div>

    <x-section icon="ti ti-user" title="Informações do Funcionário" description="Aqui estão os dados principais do funcionário.">
        <div class="list-group list-group-flush">
            <div class="list-group-item">
                <strong>Nome:</strong> {{ $funcionario->nome }}
            </div>
            <div class="list-group-item">
                <strong>E-mail:</strong> {{ $funcionario->email }}
            </div>
            <div class="list-group-item">
                <strong>Telefone:</strong> {{ $funcionario->telefone }}
            </div>
            <div class="list-group-item">
                <strong>Cargo:</strong> {{ $funcionario->cargo }}
            </div>
        </div>
    </x-section>
    @if($funcionario->enderecos)
        <x-section icon="ti ti-map-pin" title="Endereço do Funcionário" description="Endereço completo do funcionário.">
            <div class="list-group list-group-flush">
                <div class="list-group-item">
                    <strong>CEP:</strong> {{ $funcionario->enderecos->cep }}
                </div>
                <div class="list-group-item">
                    <strong>Rua:</strong> {{ $funcionario->enderecos->rua }}
                </div>
                <div class="list-group-item">
                    <strong>Número:</strong> {{ $funcionario->enderecos->numero }}
                </div>
                <div class="list-group-item">
                    <strong>Complemento:</strong> {{ $funcionario->enderecos->complemento }}
                </div>
                <div class="list-group-item">
                    <strong>Bairro:</strong> {{ $funcionario->enderecos->bairro }}
                </div>
                <div class="list-group-item">
                    <strong>Cidade:</strong> {{ $funcionario->enderecos->cidade }}
                </div>
                <div class="list-group-item">
                    <strong>Estado (UF):</strong> {{ $funcionario->enderecos->estado }}
                </div>
            </div>
        </x-section>
    @endif
@endsection
