@extends('layouts.dashboard')

@section('title', '')

@section('title-actions')
@endsection

@section('main')
    <form id="formulario" method="POST" action="{{ route('perfil.update') }}" enctype="multipart/form-data" novalidate
        autocomplete="off">
        @csrf
        <div class="d-flex justify-content-center aling-items-center">

        <div class="p-3 card w-75">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center w-100">
                    <h3 class="card-title">
                            Informações do Perfil
                    </h3>
                    <div>
                        <x-tabler.btn href="{{ route('pokemon.index') }}" class="btn btn-outline-secondary" text="Voltar" icon="ti ti-arrow-narrow-left" hint="Voltar" />
                        <x-tabler.btn-submit form="formulario" icon="ti ti-check" hint="Salvar Pokémon" />
                    </div>

                </div>

            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="mb-3">
                            <x-tabler.input id="nome" name="nome" label="Nome:"
                                placeholder="Nome" :required="true" />
                        </div>


                    </div>
                    <div class="col-lg-4">
                        <div class="mb-3">
                            <label class="form-label form-label-required" for="foto">Imagem:</label>
                            <x-tabler.dropzone id="foto" name="foto" url="{{ route('upload') }}"
                                :multiple="false" removeUrl="{{ route('upload.remove') }}" />
                        </div>
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
