<header class="navbar navbar-expand-md d-print-none">
    <div class="container-xl">
        <x-tabler.nav-bar>

            <x-application-logo />

            <x-tabler.nav-link icon="ti ti-home" :route="route('dashboard.home')" label="Home" :active="activeMenu('dashboard/home')" />

        </x-tabler.nav-bar>

        <x-tabler.nav-bar>
            <x-tabler.nav-user routeImage="" nome="nome" ocupation="Ocupação" />
        </x-tabler.nav-bar>
    </div>
</header>
