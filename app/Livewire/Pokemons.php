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
    public $pokemons = [];



    public function render()
    {
        $pokemons = Pokemon::where('user_id', Auth::id())
            ->when($this->textSearch, function ($query) {
                $query->where('name', 'like', '%' . $this->textSearch . '%');
            })
            ->paginate(10);

        return view('livewire.pokemons', [
            'pokemons' => $pokemons,
        ]);
    }
}
