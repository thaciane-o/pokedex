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
                    <div class="btn-list d-flex justify-content-end p-0 m-0">
                        <a href="{{ route('pokemon.edit', encrypt($pokemon->id)) }}" class="btn btn-ghost-primary  w-10">
                            <i class="ti ti-pencil"></i>
                        </a>
                        <form action="{{ route('pokemon.destroy', encrypt($pokemon->id)) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-ghost-danger">
                                <i class="ti ti-trash"></i>
                            </button>
                        </form>
                    </div>
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
                                        'Fogo' => 'danger',
                                        'Água' => 'primary',
                                        'Grama' => 'success',
                                        'Elétrico' => 'warning',
                                        'Normal' => 'secondary',
                                        'Voador' => 'info',
                                        'Fantasma' => 'dark',
                                        'Lutador' => 'danger',
                                        'Psíquico' => 'pink',
                                        'Gelo' => 'info',
                                        'Dragão' => 'blue',
                                        'Venenoso' => 'purple',
                                        'Metal' => 'secondary',
                                        'Pedra' => 'dark',
                                        'Terrestre' => 'brown'
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
