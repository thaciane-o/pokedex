<?php

namespace App\Http\Controllers;

use App\Models\Pokemon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PokemonController extends Controller
{
    public function index()
    {
        $pokemons = Pokemon::where('user_id', Auth::id())->paginate(12);
        return view('pokemon.index', compact('pokemons'));
    }

    public function create()
    {
        return view('pokemon.create');
    }

    public function edit($id){
        return view('pokemon.edit');
    }

    public function store(){

    }

    public function update(){

    }
    public function dados(){

    }
}
