<div>
    <div class="card-header">
        <div class="d-flex justify-content-end w-100">
            <div class="input-icon ms-2 flex-grow-1">
                <span class="input-icon-addon">
                    <i class="ti ti-search"></i>
                </span>
                <input type="text"
                       wire:model="textSearch"
                       class="form-control"
                       placeholder="Buscar"
                       wire:keypress='loadPokemon'
                       aria-label="Buscar">
            </div>
            <a href="{{ route('pokemon.create') }}" class="btn btn-outline-primary mx-2 ms-3">Adicionar</a>
        </div>
    </div>

    <div class="row row-cols-2 row-cols-md-4 g-3">
        @foreach($pokemons as $pokemon)
            <div class="col">
                <div class="card shadow-sm text-center p-3 h-100">
                    <img src="{{ asset('storage/'.$pokemon->foto) }}"
                         alt="{{ $pokemon->nome }}"
                         class="card-img-top mx-auto d-block"
                         style="width:120px; height:120px; object-fit:contain;">
                    <div class="card-body">
                        <h5 class="card-title text-capitalize">{{ $pokemon->nome }}</h5>
                        <div class="d-flex justify-content-center flex-wrap gap-1">
                            @foreach($pokemon->tipo as $tipo)
                                @php
                                    $cores = [
                                        'fogo' => 'danger',
                                        'agua' => 'primary',
                                        'grama' => 'success',
                                        'eletrico' => 'warning',
                                        'normal' => 'secondary',
                                        'voador' => 'info',
                                        'fantasma' => 'dark',
                                        'lutador' => 'danger',
                                        'psiquico' => 'pink',
                                        'gelo' => 'info',
                                        'dragão' => 'purple',
                                        'metal' => 'secondary',
                                        'pedra' => 'dark',
                                        'terra' => 'brown'
                                    ];
                                    $tipo = trim($tipo);
                                    $badgeClass = $cores[$tipo] ?? 'secondary';
                                @endphp
                                <span class="badge badge-outline-{{ $badgeClass }} px-3 py-2">
                                    {{ $tipo }}
                                </span>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Paginação -->
    <div class="mt-3">
        {{ $pokemons->links() }}
    </div>
</div>
