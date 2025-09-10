<?php

namespace App\Http\Controllers;

use App\Models\Pokemon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

use function Laravel\Prompts\error;

class PokemonController extends Controller
{
    public function index()
    {
        return view('pokemon.index');
    }

    public function create()
    {
        return view('pokemon.create');
    }

    public function edit($id)
    {
        return view('pokemon.edit');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => ['required', 'max:255'],
            'tipo' => ['required', 'array', 'max:2'],
            'tipo.*' => ['string'],
            'foto' => ['required'],

        ]);
        try {
            DB::beginTransaction();

            $pokemon = new Pokemon;
            $pokemon->nome = $request->input('nome');
            $pokemon->tipo = json_encode($request->input('tipo'));
            $pokemon->foto = $request->input('foto');
            $pokemon->save();
            DB::commit();

            flash()->success('Pokémon criado com sucesso!');
            return view('pokemon.index');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error("Erro ao cadastrar Pokémon: " . $e->getMessage());
            flash()->error('Não foi possível cadastrar:', $e->getMessage());
            return redirect()->back()->withInput();
        };
    }

    public function update() {}
    public function dados() {}
}
