@props(['title' => ''])

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
@endpush

<div class="page">

    <!-- Sidebar -->
    <aside id="sidebar" class="navbar navbar-vertical navbar-expand-sm navbar-dark bg-dark sidebar-visible">
        <div class="container-fluid">
            <!-- Logo -->
            <x-application-logo class="navbar-brand-autodark" />

            <!-- Menu -->
            <div class="navbar-collapse">
                <x-tabler.nav-bar>
                    <x-tabler.nav-link icon="ti ti-home" :route="route('dashboard.home')" label="Home" :active="activeMenu('dashboard/home')" />
                    <x-tabler.nav-link icon="ti ti-user-circle" :route="route('funcionario.index')" label="Funcionários" :active="activeMenu('funcionario*')" />
                    <x-tabler.nav-link icon="ti ti-file-search" :route="route('dashboard.log')" label="LOG" :active="activeMenu('log')" />
                    <x-tabler.nav-link icon="ti ti-message" :route="route('chat.index')" label="Chat" :active="activeMenu('chat*')" />

                </x-tabler.nav-bar>
            </div>
        </div>
    </aside>

    <!-- Conteúdo principal -->
    {{ $slot }}
</div>
@push('scripts')
<script>

    $(document).ready(function () {
        $('#toggle-sidebar-menu').toggle();

        $('.toggle-sidebar').on('click', function () {
            $('#sidebar').toggleClass('sidebar-hidden sidebar-visible');
            $('#toggle-sidebar-x').toggle();
            $('#toggle-sidebar-menu').toggle();

        });
    });
</script>
@endpush
