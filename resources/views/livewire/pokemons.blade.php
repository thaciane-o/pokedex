<div>
    <div class="card-header ">
        <div class="d-flex justify-content-end w-100">
            <div class="input-icon ms-2 flex-grow-1">
                <span class="input-icon-addon">
                    <i class="ti ti-search"></i>
                </span>
                <input type="text" wire:model="textSearch" wire:change='loadChats' class="form-control " placeholder="Buscar" aria-label="Buscar">
            </div>
            <a href="{{ route('pokemon.create') }}" class="btn btn-outline-primary mx-2 ms-3">Adicionar</a>

        </div>
    </div>
    <div class="row row-cols-2 row-cols-md-4 g-3">
        @foreach($pokemons as $pokemon)
            <div class="col">
                <div class="card shadow-sm text-center p-3 h-100">
                    <!-- Imagem -->
                    <img src="{{ asset('storage/'.$pokemon['foto']) }}"
                        alt="{{ $pokemon['nome'] }}"
                        class="card-img-top mx-auto d-block"
                        style="width:120px; height:120px; object-fit:contain;">

                    <!-- Nome -->
                    <div class="card-body">
                        <h5 class="card-title text-capitalize">{{ $pokemon['nome'] }}</h5>

                        <!-- Tipos -->
                        @php
                            $tipos = explode(',', $pokemon['tipo']);

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
                                'Dragão' => 'purple',
                                'Metal' => 'secondary',
                                'Pedra' => 'dark',
                                'Terra' => 'brown'
                            ];
                        @endphp

                        <div class="d-flex justify-content-center flex-wrap gap-1">
                            @foreach($tipos as $tipo)
                                @php
                                    $tipo = trim($tipo);
                                    $badgeClass = $cores[$tipo] ?? 'secondary';
                                @endphp
                                <span class="badge badge-outline badge-outline-{{ $badgeClass }} px-3 py-2">
                                    {{ $tipo }}
                                </span>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

    </div>
</div>
