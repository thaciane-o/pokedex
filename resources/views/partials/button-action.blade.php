@php
    $id = $row->id; // ou qualquer campo identificador do seu objeto
@endphp

<div class="btn-list">

    {{-- Botão de Visualizar --}}
    @isset($data['show'])
    <a href="{{ $data['show']['route'] }}" class="btn btn-sm btn-info" title="Visualizar">
            <i class="ti ti-eye" ></i>

    </a>
    @endisset

    {{-- Botão de Editar --}}
    @isset($data['edit'])
    <a href="{{ $data['edit']['route']}}" class="btn btn-sm btn-warning" title="Editar">
            <i class="ti ti-edit" > </i>

    </a>
    @endisset

    {{-- Botão de Deletar --}}
    @isset($data['delete'])
    <button class="btn btn-sm btn-danger" onclick="confirmDelete('{{$data['delete']['route'], $data['delete']['id'] }}')" title="Excluir">
            <i class="ti ti-trash" ></i>

    </button>
    @endisset

</div>

