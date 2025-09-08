@props(['title' => ''])
@push('styles')
    <link rel="stylesheet" href="{{asset('css/dashboard.css')}}">
@endpush

    <!-- Conteúdo principal -->
    <div class="page-wrapper">

        <!-- Conteúdo -->
        <div class="page-body mt-0">
                    <!-- Top Bar -->
        <div class="top-bar d-flex justify-content-end align-items-center px-4 py-3 bg-white shadow-sm">
            <!-- Perfil do Usuário -->
            <x-tabler.nav-user />
        </div>

        <!-- Cabeçalho -->
        <div class="page-header d-print-none">
            <div class="row g-2 align-items-center">
                <div class="col mx-2">
                    <h2 class="page-title mb-0 pb-0">{{ $title }}</h2>
                </div>
            </div>
        </div>
            <div class="mx-2">
                {!! $slot !!}
            </div>
        </div>
    </div>
