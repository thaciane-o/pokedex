@extends('layouts.dashboard')
@section('title', 'Novo Funcionário')

@section('main')
    <form action="{{ route('funcionario.store') }}" method="POST" class="px-3">
        @csrf

        <div class="d-flex justify-content-end mb-3">
            <a class="btn btn-outline-secondary me-2" href="{{route('funcionario.index')}}">Voltar</a>
            <button type="submit" class="btn btn-primary">
                <i class="ti ti-device-floppy me-1"></i> Salva
            </button>
        </div>

        <x-section
            icon="ti ti-user"
            title="Informações do Funcionário"
            description="Preencha os dados para cadastrar um novo funcionário.">

            <div class="row">
                <div class="col-md-6 mb-3">
                    <x-tabler.input
                        label="Nome"
                        name="nome"
                        id="nome"
                        :required="true"
                        placeholder="xxxxx" />
                </div>

                <div class="col-md-6 mb-3">
                    <x-tabler.input
                        label="E-mail"
                        name="email"
                        id="email"
                        type="email"
                        :required="true"
                        placeholder="teste@gmail.com"
                />
                </div>

                <div class="col-md-6 mb-3">
                    <x-tabler.input
                        label="Cargo"
                        name="cargo"
                        id="cargo"
                        :required="true"
                        placeholder="Gerente"
                />
                </div>


                <div class="col-md-6 mb-3">
                    <x-tabler.input
                        label="Telefone"
                        name="telefone"
                        id="telefone"
                        data-mask="(00) 0000-0000" placeholder="(00) 0000-0000"
                        autocomplete="off"
                />
                </div>
            </div>

        </x-section>

        <div class="hr-text"></div>
        <x-section
            icon="ti ti-world-pin"
            title="Endereço"
            description="Cadastra algum endereço.">

                <div class="row g-3">
                    <div class="col-md-3">
                        <x-tabler.input
                            label="CEP"
                            name="cep"
                            id="cep"
                            placeholder="Digite o CEP"
                            required />
                    </div>

                    <div class="col-md-6">
                        <x-tabler.input
                            name="rua"
                            label="Rua"
                            id="rua"
                            placeholder="Cadastre a rua"
                            required />
                    </div>

                    <div class="col-md-3">
                        <x-tabler.input
                            name="numero"
                            label="Número"
                            id="numero"
                            placeholder="Digite o número"
                            required />
                    </div>

                    <div class="col-md-6">
                        <x-tabler.input
                            name="complemento"
                            label="Complemento"
                            id="complemento"
                            placeholder="Apartamento, bloco, etc."
                                />
                    </div>

                    <div class="col-md-6">
                        <x-tabler.input
                            name="bairro"
                            label="Bairro"
                            id="bairro"
                            placeholder="Digite o bairro"
                            required />
                    </div>

                    <div class="col-md-6">
                        <x-tabler.input
                            label="Cidade"
                            name="cidade"
                            id="cidade"
                            placeholder="Digite a cidade"
                            required />
                    </div>

                    <div class="col-md-6">
                        <x-tabler.input
                            name="estado"
                            label="Estado"
                            id="estado"
                            placeholder="UF"
                            required />
                    </div>
                </div>
        </x-section>

    </form>

@endsection

@push('scripts')
<script>
    $(document).ready(function () {
        var phoneMaskBehavior = function (val) {
            return val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-0000';
        };

        var phoneOptions = {
            onKeyPress: function (val, e, field, options) {
                field.mask(phoneMaskBehavior.apply({}, arguments), options);
            }
        };

        $('[name="telefone"]').mask(phoneMaskBehavior, phoneOptions);

        const cep = $('[name="cep"]');
        cep.mask('00000-000');

        $('#saveEndereco').click(function (){
            $('#ModalEndereco').modal('hide');
        });

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
                    $('#numero').val(data.numero || '');

                }
            });
        });

        });
</script>
@endpush
