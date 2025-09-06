<?php

namespace App\Http\Controllers;

use App\Models\Endereco;
use App\Models\Funcionario;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Validate;
use Yajra\DataTables\Facades\DataTables;

class FuncionarioController extends Controller
{
     public function index()
    {
        // Lógica para listar funcionario
        // Pode incluir paginação, filtros, etc.
        return view('funcionario.index');
    }

    public function create()
    {
        // Lógica para exibir o formulário de criação de Funcionario
        return view('funcionario.create');
    }

    public function store(Request $request)
    {
        try{
            DB::beginTransaction();
            //Validando a criação do funcionario
            $validatedFuncionario = $request->validate([
                'nome' => 'required|string|max:255',
                'email' => 'required|email|max:255',
                'cargo' => 'required|string|max:255',
                'telefone' => 'nullable|string|max:20',
            ]);
            //Validando a criação do endereço
            $validateEndereco = $request->validate([
                    'cep' => 'required|string|size:9',
                    'rua' => 'required|string',
                    'numero' => 'required|string',
                    'complemento' => 'nullable|string',
                    'bairro' => 'required|string',
                    'cidade' => 'required|string',
                    'estado' => 'required|string|size:2',
            ]);

            $user = User::create([
                'email' => $validatedFuncionario['email'],
                'name' => $validatedFuncionario['nome'],
                'password' => hash('sha256','Primerio@Acesso'),
            ]);
            $validatedFuncionario['users_id'] = $user->id;
            $validatedFuncionario['empresa_id'] = 1;
            $funcionario = Funcionario::create($validatedFuncionario);

            $validateEndereco['funcionario_id'] = $funcionario->id;
            $Endereco = Endereco::create($validateEndereco);
            DB::commit();
            flash()->success('Funcionario criado com sucesso!');
            Log::info('Funcionario criado com sucesso',[ $validateEndereco,$validatedFuncionario]);
            return redirect()->route('funcionario.index');
        }catch(\Exception $e){
            DB::rollBack();

            Log::error('Erro ao criar Funcionario', [
                'error' => $e->getMessage(),
                'cpf' => $request->input('cpf'),
                'telefone' => $request->input('telefone'),
                'endereco' => $request->input('endereco'),
            ]);
            flash()->error('Erro ao criar Funcionario: ' . $e->getMessage());
            return redirect()->back();
        }
    }

    public function show($id)
    {
        $funcionario = Funcionario::findOrFail($id); // Verifica se o Funcionario existe
        return view('funcionario.show', compact('funcionario')); // Exibe os detalhes do Funcionario
    }

    public function edit($id)
    {
        $funcionario = Funcionario::findOrFail($id); // Verifica se o Funcionario existe
        return view('funcionario.edit', compact('funcionario')); // Exibe o formulário de edição do Funcionario
    }

    public function update(Request $request, $id)
    {
        try{
            DB::beginTransaction();
            //Validando a criação do funcionario
            $validatedFuncionario = $request->validate([
                'nome' => 'required|string|max:255',
                'email' => 'required|email|max:255',
                'cargo' => 'required|string|max:255',
                'telefone' => 'nullable|string|max:20',
            ]);
            //Validando a criação do endereço
            $validateEndereco = $request->validate([
                    'cep' => 'required|string|size:9',
                    'rua' => 'required|string',
                    'numero' => 'required|string',
                    'complemento' => 'nullable|string',
                    'bairro' => 'required|string',
                    'cidade' => 'required|string',
                    'estado' => 'required|string|size:2',
            ]);

            $funcionario = Funcionario::find($id);
            if (!$funcionario) {
                flash()->error('Funcionário não encontrado');
                return redirect()->back()->with('error', 'Funcionário não encontrado.');
            }

            $funcionario->update($validatedFuncionario);
            $endereco = $funcionario->endereco;
            if ($endereco) {
                $endereco->update($validateEndereco);
            }

            DB::commit();
            flash()->success('Funcionario criado com sucesso!');
            Log::info('Funcionario criado com sucesso',[ $validateEndereco,$validatedFuncionario]);
            return redirect()->route('funcionario.index');
        }catch(\Exception $e){
            DB::rollBack();
            Log::error('Erro ao criar Funcionario', [
                'error' => $e->getMessage(),
                'cpf' => $request->input('cpf'),
                'telefone' => $request->input('telefone'),
                'endereco' => $request->input('endereco'),
            ]);
            flash()->error('Erro ao criar Funcionario: ' . $e->getMessage());
            return redirect()->back();
        }
    }

    public function destroy($id)
    {
        try {
            DB::beginTransaction();
            $Funcionario = Funcionario::findOrFail($id); // Verifica se o Funcionario existe
            $Funcionario->delete(); // Exclui o Funcionario
            DB::commit();
            flash()->success('Funcionario excluído com sucesso!');
            Log::info('Funcionario excluído com sucesso', ['id' => $Funcionario->id]);
            return redirect()->route('funcionario.index')->with('success', 'Funcionario excluído com sucesso!');
        } catch (\Exception $e) {
            DB::rollBack();
            flash()->error('Erro ao excluir Funcionario: ' . $e->getMessage());
            Log::error('Erro ao excluir Funcionario', [
                'error' => $e->getMessage(),
                'id' => $id,
            ]);
            return redirect()->back()->withErrors(['error' => 'Erro ao excluir Funcionario: ' . $e->getMessage()]);
        }
    }

    public function dados()
    {
        $query = Funcionario::query();

        return datatables()->of($query)
            ->addColumn('action', function ($row) {
                $id = $row->id;
                $data = [
                    'show' => ['route' => route('funcionario.show', $id), 'id'=>$id],
                    'delete' => ['route' => route('funcionario.destroy', $id), 'id'=>$id]
                ];

                return view('partials.button-action', compact('data','row'))->render();
            })
            ->rawColumns(['action'])
            ->make(true);
    }
    public function fileStore(Request $request)
    {
        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');
            $path = $file->store('uploads', 'public');
            return response()->json(['success' => true, 'path' => $path]);
        }

        return response()->json(['success' => false], 400);
    }

    public function fileDestroy(Request $request)
    {
        $filename = $request->input('filename');

        if ($filename && Storage::disk('public')->exists('uploads/' . $filename)) {
            Storage::disk('public')->delete('uploads/' . $filename);
            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false, 'message' => 'Arquivo não encontrado'], 404);
    }

}
