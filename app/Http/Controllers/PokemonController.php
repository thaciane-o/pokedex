<?php

namespace App\Http\Controllers;

use App\Models\Pokemon;
use Illuminate\Http\Request;
<<<<<<< HEAD
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

use function Laravel\Prompts\error;
=======
use Illuminate\Support\Facades\Auth;
>>>>>>> listar-pokemon

class PokemonController extends Controller
{
    public function index()
    {
<<<<<<< HEAD
        $dados = $this->dados();
        return view('pokemon.index', $dados);
=======
        $pokemons = Pokemon::where('user_id', Auth::id())->paginate(12);
        return view('pokemon.index', compact('pokemons'));
>>>>>>> listar-pokemon
    }

    public function create()
    {
        return view('pokemon.create');
    }

    public function edit($id)
    {
        $pokemon = Pokemon::findOrFail(decrypt($id));
        $tiposSelecionados = [];
        if(is_array($pokemon->tipo)) {
            $tiposSelecionados = $pokemon->tipo;
        } else {
            $tiposSelecionados = explode(',', $pokemon->tipo);
        }

        return view('pokemon.edit', compact('pokemon', 'tiposSelecionados'));
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
            $pokemon->tipo = $request->input('tipo');
            $pokemon->foto = $request->input('foto');
            $pokemon->save();
            DB::commit();

            flash()->success('Pokémon criado com sucesso!');
            return redirect()->route('pokemon.index');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error("Erro ao cadastrar Pokémon: " . $e->getMessage());
            flash()->error('Não foi possível cadastrar:', $e->getMessage());
            return redirect()->back()->withInput();
        };
    }

<<<<<<< HEAD
    public function update(Request $request, $id)
    {
        
=======
    public function update(){

    }
    public function dados(){

>>>>>>> listar-pokemon
    }

    public function destroy($id)
    {
       
    }

    public function dados()
    {
        $pokemons = Pokemon::all();

        foreach ($pokemons as $pokemon) {
            $pokemon->tipo = implode(', ', $pokemon->tipo);
        }

        return ['pokemons' => $pokemons];
    }
}
