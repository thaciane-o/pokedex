@extends('layouts.app')

@section('content')
    <x-layouts.dashboard :title="View::getSection('title')">
    <div class="d-flex justify-content-end mx-3">
    </div>
    <div class="d-flex justify-content-center aling-items-center">
        <div class="p-3 card w-75">
            <livewire:pokemons>
        </div>
    </div>
    </x-layouts.dashboard>
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
