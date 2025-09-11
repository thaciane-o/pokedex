<?php

namespace App\Http\Controllers;

use App\Models\Pokemon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PokemonController extends Controller
{

    public $uploadController;

    public function __construct()
    {
        $this->uploadController = new UploadController();
    }

    public function index()
    {
        $dados = $this->dados();
        return view('pokemon.index', $dados);
    }

    public function create()
    {
        return view('pokemon.create');
    }

    public function edit($id)
    {
        $pokemon = Pokemon::findOrFail(decrypt($id));
        $arquivos = $pokemon->foto;
        return view('pokemon.edit', compact('pokemon', 'arquivos'));
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
        } catch (Exception $e) {
            DB::rollBack();
            Log::error("Erro ao cadastrar Pokémon: " . $e->getMessage());
            flash()->error('Não foi possível cadastrar:', $e->getMessage());
            return redirect()->back()->withInput();
        };
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nome' => ['required', 'max:255'],
            'tipo' => ['required', 'array', 'max:2'],
            'tipo.*' => ['string'],
            'foto' => ['nullable'],
        ]);

        try {
            DB::beginTransaction();
            $cod = decrypt($id);

            $pokemon = Pokemon::findOrFail($cod);
            $pokemon->nome = $request->input('nome');
            $pokemon->tipo = $request->input('tipo');
            if($request->input('foto') != null)
                $pokemon->foto = $request->input('foto');

            $pokemon->save();

            DB::commit();
            flash()->success('Pokémon atualizado com sucesso!');
            return redirect()->route('pokemon.index');
        } catch (Exception $e) {
            DB::rollBack();
            Log::error("Erro ao atualizar Pokémon: " . $e->getMessage());
            flash()->error('Não foi possível atualizar:', $e->getMessage());
            return redirect()->back()->withInput();
        };
    }

    public function destroy($id)
    {
        try {
            $cod = decrypt($id);
            $pokemon = Pokemon::findOrFail($cod);
            $this->uploadController->remove(new Request((['path' => $pokemon->foto])));
            $pokemon->delete();

            flash()->success('Pokémon excluído com sucesso!');
            return redirect()->route('pokemon.index');
        } catch (Exception $e) {
            Log::error("Erro ao excluir Pokémon: " . $e->getMessage());
            flash()->error('Não foi possível excluir:', $e->getMessage());
            return redirect()->back();
        }
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
