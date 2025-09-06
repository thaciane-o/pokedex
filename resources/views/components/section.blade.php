@props(['icon', 'title', 'description'])

<section class="container-fluid bg-white shadow-sm rounded border mb-4 p-4">
    <div class="row align-items-start">
        <!-- Coluna esquerda: ícone, título e descrição -->
        <div class="col-md-3 pe-4 mb-3 mb-md-0">
            <div class="d-flex align-items-center mb-3">
                <i class="{{ $icon ?? 'ti ti-info-circle' }} fs-4"></i>
                <h2 class="fw-bold mb-0">{{ $title }}</h2>
            </div>
            <p class="text-muted fs-5 mb-0">{{ $description }}</p>
        </div>

        <!-- Coluna direita: slot dinâmico (formulários, inputs, etc) -->
        <div class="col-md-8 ps-4 border-start">
            {{ $slot }}
        </div>
    </div>
</section>
