@props(['routeImage', 'nome', 'ocupation'])

<div class="navbar-nav flex-row order-md-last ms-auto">
    <div class="nav-item dropdown">
        <a href="#" class="nav-link d-flex lh-1 text-reset" data-bs-toggle="dropdown" aria-label="Open user menu">
            <span class="avatar avatar-sm">
                <img src="{{ getUser()->image->caminho ?? '' }}" alt="Imagem do perfil">
            </span>
            <div class="d-none d-xl-block ps-2">
                <div>{{ getUser()->name }}</div>
                <div class="mt-1 small text-secondary">{{ getUser()->funcionario ? getUser()->funcionario->ocupation : '' }}</div>
            </div>
        </a>

        <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
            <a href="{{ route('logout') }}" class="dropdown-item">Sair</a>
        </div>
    </div>
</div>
