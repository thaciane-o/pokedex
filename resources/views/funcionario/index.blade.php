@extends('layouts.dashboard')
@section('title', 'Funcionarios')

@section('main')
    <div class="d-flex justify-content-end mx-3">
        <a href="{{ route('funcionario.create') }}" class="btn btn-primary d-none d-sm-inline-block">Criar</a>
    </div>
    <div class="p-2 mt-3 ms-5 me-3 card">
        <x-tabler.dataTable
            id="tabela-funcionario"
            :head="['Nome', 'Cargo', 'Email', 'Ações']"
            :body="[
                ['data' => 'nome' ],
                ['data' => 'cargo'] ,
                ['data' => 'email' ],
                ['data' => 'action', 'orderable' => false, 'searchable' => false ]
            ]"
            route="funcionario.dados"
        />
    </div>
@endsection

@push('scripts')
<script>
    function confirmDelete(url) {
        Notiflix.Confirm.show(
            'Confirmação',
            'Tem certeza que deseja excluir este registro?',
            'Sim',
            'Cancelar',
            function okCb() {
                const form = document.createElement('form');
                form.action = url;
                form.method = 'POST';

                const method = document.createElement('input');
                method.type = 'hidden';
                method.name = '_method';
                method.value = 'DELETE';

                const token = document.createElement('input');
                token.type = 'hidden';
                token.name = '_token';
                token.value = '{{ csrf_token() }}';

                form.appendChild(method);
                form.appendChild(token);
                document.body.appendChild(form);
                form.submit();
            },
            function cancelCb() {
                Notiflix.Notify.info('Operação cancelada');
            }
        );
    }
</script>
@endpush
