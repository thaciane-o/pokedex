<?php

namespace App\Livewire;

use App\Models\Pokemon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class Pokemons extends Component
{
      use WithPagination;

    public $textSearch = '';

    // Reseta para a primeira página ao mudar a busca
    public function loadPokemon()
    {
        $this->resetPage();
    }

    public function render()
    {
        $pokemons = Pokemon::where('user_id', Auth::id())
            ->when($this->textSearch, function ($query) {
                $query->where('nome', 'like', '%' . $this->textSearch . '%');
            })
            ->paginate(10);

        return view('livewire.pokemons', compact('pokemons'));
    }
}
