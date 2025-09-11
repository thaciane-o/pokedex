@extends('layouts.dashboard')
@section('pre-title')
    Editando Pokémon 
@endsection
@section('title', 'Pokémon')

@section('title-actions')
    <x-tabler.btn href="{{ route('pokemon.index') }}"  class="btn btn-secondary" icon="ti ti-arrow-narrow-left" hint="Voltar" text="Voltar" />
    <x-tabler.btn-submit form="formulario" icon="ti ti-check" hint="Atualizar Pokémon" text="Salvar" />
@endsection

@if ($errors->any())
    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Notiflix.Notify.failure('Por favor, corrija os erros no formulário: ' + '{{ implode(' ', $errors->all()) }}');
            });
        </script>
    @endpush
@endif

@section('main')
    <form id="formulario" method="POST" action="{{ route('pokemon.update', encrypt($pokemon->id)) }}" enctype="multipart/form-data" novalidate
        autocomplete="off">
        @method('PUT')
        @csrf

        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Informações do Pokémon</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="mb-3">
                            <x-tabler.input id="nome" name="nome" label="Nome do Pokémon:"
                                placeholder="Ex: Charmander" value="{{ old('nome', $pokemon->nome) }}" :required="true" />
                        </div>

                        <div class="mb-3">
                            <label class="form-label form-label-required">
                                Escolha os Tipos do Pokémon: <b>(Máx. 2)</b>
                                <span class="text-danger">*</span>
                            </label>

                            <div class="row row-cols-4 row-cols-sm-5 row-cols-md-6 row-cols-lg-7 g-2">
                                <div class="col">
                                    <label class="form-imagecheck">
                                        <input name="tipo[]" id="tipo" type="checkbox" value="Normal" 
                                            class="form-imagecheck-input" />
                                        <span class="form-imagecheck-figure">
                                            <img src="{{ asset('img/tipo_pokemon/normal.png') }}" alt="Normal"
                                                width="64" height="64" class="form-imagecheck-image">
                                        </span>
                                    </label>
                                </div>
                                <div class="col">
                                    <label class="form-imagecheck">
                                        <input name="tipo[]" id="tipo" type="checkbox" value="Fogo" 
                                            class="form-imagecheck-input" />
                                        <span class="form-imagecheck-figure">
                                            <img src="{{ asset('img/tipo_pokemon/fogo.png') }}" alt="Fogo"
                                                width="64" height="64" class="form-imagecheck-image">
                                        </span>
                                    </label>
                                </div>
                                <div class="col">
                                    <label class="form-imagecheck">
                                        <input name="tipo[]" id="tipo" type="checkbox" value="Água" 
                                            class="form-imagecheck-input" />
                                        <span class="form-imagecheck-figure">
                                            <img src="{{ asset('img/tipo_pokemon/agua.png') }}" alt="Água"
                                                width="64" height="64" class="form-imagecheck-image">
                                        </span>
                                    </label>
                                </div>
                                <div class="col">
                                    <label class="form-imagecheck">
                                        <input name="tipo[]" id="tipo" type="checkbox" value="Grama"
                                            class="form-imagecheck-input" />
                                        <span class="form-imagecheck-figure">
                                            <img src="{{ asset('img/tipo_pokemon/grama.png') }}" alt="Grama"
                                                width="64" height="64" class="form-imagecheck-image"> 
                                        </span>
                                    </label>
                                </div>
                                <div class="col">
                                    <label class="form-imagecheck">
                                        <input name="tipo[]" id="tipo" type="checkbox" value="Elétrico" 
                                            class="form-imagecheck-input" />
                                        <span class="form-imagecheck-figure">
                                            <img src="{{ asset('img/tipo_pokemon/eletrico.png') }}" alt="Elétrico"
                                                width="64" height="64" class="form-imagecheck-image">
                                        </span>
                                    </label>
                                </div>
                                <div class="col">
                                    <label class="form-imagecheck">
                                        <input name="tipo[]" id="tipo" type="checkbox" value="Gelo"
                                            class="form-imagecheck-input" />
                                        <span class="form-imagecheck-figure">
                                            <img src="{{ asset('img/tipo_pokemon/gelo.png') }}" alt="Gelo"
                                                width="64" height="64" class="form-imagecheck-image">
                                        </span>
                                    </label>
                                </div>
                                <div class="col">
                                    <label class="form-imagecheck">
                                        <input name="tipo[]" id="tipo" type="checkbox" value="Lutador" 
                                            class="form-imagecheck-input" />
                                        <span class="form-imagecheck-figure">
                                            <img src="{{ asset('img/tipo_pokemon/lutador.png') }}" alt="Lutador"
                                                width="64" height="64" class="form-imagecheck-image">
                                        </span>
                                    </label>
                                </div>
                                <div class="col">
                                    <label class="form-imagecheck">
                                        <input name="tipo[]" id="tipo" type="checkbox" value="Venenoso"
                                            class="form-imagecheck-input" />
                                        <span class="form-imagecheck-figure">
                                            <img src="{{ asset('img/tipo_pokemon/venenoso.png') }}" alt="Veneno"
                                                width="64" height="64" class="form-imagecheck-image">
                                        </span>
                                    </label>
                                </div>
                                <div class="col">
                                    <label class="form-imagecheck">
                                        <input name="tipo[]" id="tipo" type="checkbox" value="Terrestre"
                                            class="form-imagecheck-input" />
                                        <span class="form-imagecheck-figure">
                                            <img src="{{ asset('img/tipo_pokemon/terrestre.png') }}" alt="Terra"
                                                width="64" height="64" class="form-imagecheck-image">
                                        </span>
                                    </label>
                                </div>
                                <div class="col">
                                    <label class="form-imagecheck">
                                        <input name="tipo[]" id="tipo" type="checkbox" value="Voador"
                                            class="form-imagecheck-input" />
                                        <span class="form-imagecheck-figure">
                                            <img src="{{ asset('img/tipo_pokemon/voador.png') }}" alt="Voador"
                                                width="64" height="64" class="form-imagecheck-image">
                                        </span>
                                    </label>
                                </div>
                                <div class="col">
                                    <label class="form-imagecheck">
                                        <input name="tipo[]" id="tipo" type="checkbox" value="Psíquico"
                                            class="form-imagecheck-input" />
                                        <span class="form-imagecheck-figure">
                                            <img src="{{ asset('img/tipo_pokemon/psiquico.png') }}" alt="Psíquico"
                                                width="64" height="64" class="form-imagecheck-image">
                                        </span>
                                    </label>
                                </div>
                                <div class="col">
                                    <label class="form-imagecheck">
                                        <input name="tipo[]" id="tipo" type="checkbox" value="Inseto"
                                            class="form-imagecheck-input" />
                                        <span class="form-imagecheck-figure">
                                            <img src="{{ asset('img/tipo_pokemon/inseto.png') }}" alt="Inseto"
                                                width="64" height="64" class="form-imagecheck-image">
                                        </span>
                                    </label>
                                </div>
                                <div class="col">
                                    <label class="form-imagecheck">
                                        <input name="tipo[]" id="tipo" type="checkbox" value="Pedra"
                                            class="form-imagecheck-input" />
                                        <span class="form-imagecheck-figure">
                                            <img src="{{ asset('img/tipo_pokemon/pedra.png') }}" alt="Pedra"
                                                width="64" height="64" class="form-imagecheck-image">
                                        </span>
                                    </label>
                                </div>
                                <div class="col">
                                    <label class="form-imagecheck">
                                        <input name="tipo[]" id="tipo" type="checkbox" value="Fantasma"
                                            class="form-imagecheck-input" />
                                        <span class="form-imagecheck-figure">
                                            <img src="{{ asset('img/tipo_pokemon/fantasma.png') }}" alt="Fantasma"
                                                width="64" height="64" class="form-imagecheck-image">
                                        </span>
                                    </label>
                                </div>
                                <div class="col">
                                    <label class="form-imagecheck"> 
                                        <input name="tipo[]" id="tipo" type="checkbox" value="Dragão" 
                                            class="form-imagecheck-input" />
                                        <span class="form-imagecheck-figure">
                                            <img src="{{ asset('img/tipo_pokemon/dragao.png') }}" alt="Dragão"
                                                width="64" height="64" class="form-imagecheck-image">
                                        </span>
                                    </label>
                                </div>
                                <div class="col">
                                    <label class="form-imagecheck">
                                        <input name="tipo[]" id="tipo" type="checkbox" value="Noturno" 
                                            class="form-imagecheck-input" />
                                        <span class="form-imagecheck-figure">
                                            <img src="{{ asset('img/tipo_pokemon/noturno.png') }}" alt="Sombrio"
                                                width="64" height="64" class="form-imagecheck-image">
                                        </span>
                                    </label>
                                </div>
                                <div class="col">
                                    <label class="form-imagecheck">
                                        <input name="tipo[]" id="tipo" type="checkbox" value="Metal" 
                                            class="form-imagecheck-input" />
                                        <span class="form-imagecheck-figure">
                                            <img src="{{ asset('img/tipo_pokemon/metal.png') }}" alt="Aço"
                                                width="64" height="64" class="form-imagecheck-image">
                                        </span>
                                    </label>
                                </div>
                                <div class="col">
                                    <label class="form-imagecheck">
                                        <input name="tipo[]" id="tipo" type="checkbox" value="Fada" 
                                            class="form-imagecheck-input" />
                                        <span class="form-imagecheck-figure">
                                            <img src="{{ asset('img/tipo_pokemon/fada.png') }}" alt="Fada"
                                                width="64" height="64" class="form-imagecheck-image">
                                        </span>
                                    </label>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="col-lg-4">
                        <div class="mb-3">
                            <label class="form-label form-label-required" for="foto">Imagem do Pokémon:</label>
                            <x-tabler.dropzone id="foto" name="foto" url="{{ route('upload') }}" value="{{ old('foto', $pokemon->foto) }}"
                                :multiple="false" removeUrl="{{ route('upload.remove') }}" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const checkboxSelecionados = document.querySelectorAll('.form-imagecheck-input');
            const maxTipos = 2;

            checkboxSelecionados.forEach(checkbox => {
                checkbox.addEventListener('change', () => {
                    const qtdCheckbox = document.querySelectorAll('.form-imagecheck-input:checked')
                        .length;

                    if (qtdCheckbox >= maxTipos) {
                        checkboxSelecionados.forEach(cb => {
                            if (!cb.checked) {
                                cb.disabled = true;
                            }
                        });
                    } else {
                        checkboxSelecionados.forEach(cb => {
                            cb.disabled = false;
                        });
                    }
                });
            });
        });
    </script>
@endpush
