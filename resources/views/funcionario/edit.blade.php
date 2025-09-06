@extends('layouts.dashboard')
@section('title', 'Editar Funcionário')

@section('main')
    <form action="{{ route('funcionario.update', $funcionario->id) }}" method="POST" class="px-3">
        @csrf
        @method('PUT')

        <div class="d-flex justify-content-end mb-3">
            <a class="btn btn-outline-secondary me-2" href="{{ route('funcionario.index') }}">
                <i class="ti ti-arrow-left me-1"></i> Voltar
            </a>
            <button type="submit" class="btn btn-primary">
                <i class="ti ti-device-floppy me-1"></i> Salvar
            </button>
        </div>

        <x-section
            icon="ti ti-user"
            title="Informações do Funcionário"
            description="Atualize os dados do funcionário.">

            <div class="row">
                <div class="col-md-6 mb-3">
                    <x-tabler.input
                        label="Nome"
                        name="nome"
                        id="nome"
                        :required="true"
                        value="{{ old('nome', $funcionario->nome) }}"
                        placeholder="Nome completo" />
                </div>

                <div class="col-md-6 mb-3">
                    <x-tabler.input
                        label="E-mail"
                        name="email"
                        id="email"
                        type="email"
                        :required="true"
                        value="{{ old('email', $funcionario->email) }}"
                        placeholder="teste@email.com" />
                </div>

                <div class="col-md-6 mb-3">
                    <x-tabler.input
                        label="Cargo"
                        name="cargo"
                        id="cargo"
                        :required="true"
                        value="{{ old('cargo', $funcionario->cargo) }}"
                        placeholder="Gerente, Analista..." />
                </div>

                <div class="col-md-6 mb-3">
                    <x-tabler.input
                        label="Telefone"
                        name="telefone"
                        id="telefone"
                        value="{{ old('telefone', $funcionario->telefone) }}"
                        data-mask="(00) 0000-0000"
                        autocomplete="off"
                        placeholder="(00) 00000-0000" />
                </div>
            </div>
        </x-section>

        <div class="hr-text"></div>

        <x-section
            icon="ti ti-world-pin"
            title="Endereço"
            description="Atualize o endereço do funcionário.">

            <div class="row g-3">
                <div class="col-md-3">
                    <x-tabler.input
                        label="CEP"
                        name="cep"
                        id="cep"
                        placeholder="Digite o CEP"
                        value="{{ old('cep', $funcionario->enderecos->cep ?? '') }}"
                        required />
                </div>

                <div class="col-md-6">
                    <x-tabler.input
                        name="rua"
                        label="Rua"
                        id="rua"
                        placeholder="Cadastre a rua"
                        value="{{ old('rua', $funcionario->enderecos->rua ?? '') }}"
                        required />
                </div>

                <div class="col-md-3">
                    <x-tabler.input
                        name="numero"
                        label="Número"
                        id="numero"
                        placeholder="Digite o número"
                        value="{{ old('numero', $funcionario->enderecos->numero ?? '') }}"
                        required />
                </div>

                <div class="col-md-6">
                    <x-tabler.input
                        name="complemento"
                        label="Complemento"
                        id="complemento"
                        placeholder="Apartamento, bloco, etc."
                        value="{{ old('complemento', $funcionario->enderecos->complemento ?? '') }}" />
                </div>

                <div class="col-md-6">
                    <x-tabler.input
                        name="bairro"
                        label="Bairro"
                        id="bairro"
                        placeholder="Digite o bairro"
                        value="{{ old('bairro', $funcionario->enderecos->bairro ?? '') }}"
                        required />
                </div>

                <div class="col-md-6">
                    <x-tabler.input
                        label="Cidade"
                        name="cidade"
                        id="cidade"
                        placeholder="Digite a cidade"
                        value="{{ old('cidade', $funcionario->enderecos->cidade ?? '') }}"
                        required />
                </div>

                <div class="col-md-6">
                    <x-tabler.input
                        name="estado"
                        label="Estado"
                        id="estado"
                        placeholder="UF"
                        value="{{ old('estado', $funcionario->enderecos->estado ?? '') }}"
                        required />
                </div>
            </div>
        </x-section>
    </form>
@endsection

@push('scripts')
<script>
    $(document).ready(function () {
        const phoneMaskBehavior = function (val) {
            return val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-0000';
        };

        const phoneOptions = {
            onKeyPress: function (val, e, field, options) {
                field.mask(phoneMaskBehavior.apply({}, arguments), options);
            }
        };

        $('[name="telefone"]').mask(phoneMaskBehavior, phoneOptions);
        const cep = $('[name="cep"]');
        cep.mask('00000-000');

        cep.on('change', function () {
            $.ajax({
                async: true,
                url: "https://viacep.com.br/ws/" + cep.val() + "/json/",
                type: 'GET',
                success: function (data) {
                    $('#rua').val(data.logradouro || '');
                    $('#bairro').val(data.bairro || '');
                    $('#cidade').val(data.localidade || '');
                    $('#estado').val(data.uf || '');
                    $('#complemento').val(data.complemento || '');
                }
            });
        });
    });
</script>
@endpush
