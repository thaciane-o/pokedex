<?php

namespace Tests\Feature;

use App\Models\Empresa;
use App\Models\Endereco;
use App\Models\Funcionario;
use App\Models\User;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth as FacadesAuth;
use Tests\TestCase;

class FuncionarioTest extends TestCase
{
    use RefreshDatabase;
    protected function setUp(): void
    {
        parent::setUp();

        // Cria e autentica um usuário padrão para todos os testes
        $user = User::factory()->create();
        $this->actingAs($user);


        Empresa::create([
            'nome' => 'a',
            'cnpj' => 'a',
        ]);

    }
    /**
     * A basic feature test example.
     */
    public function test_index(): void
    {
        // Acesso às rotas de listagem e criação
        $this->get(route('funcionario.index'))->assertStatus(200);
    }

    public function test_create(){

        $this->get(route('funcionario.create'))->assertStatus(200);
    }

    public function test_store(){

        // Cria dados válidos para inserção (sem salvar ainda no banco)
        $funcionario = Funcionario::factory()->make()->toArray();
        $endereco = Endereco::factory()->make()->toArray();
        $storeTeste = array_merge($funcionario, $endereco);
        // Testa o store
        $this->post(route('funcionario.store'), $storeTeste)->assertStatus(302);
    }

    public function test_show(){

        // Recupera o funcionario recém-criado
        $funcionario = Funcionario::factory()->create();

        // Acessando show
        $this->get(route("funcionario.show", $funcionario->id))->assertStatus(200);

    }
    public function test_edit(){

        // Recupera o funcionario recém-criado
        $funcionario = Funcionario::factory()->create();

        // Testa o edit
        $this->get(route("funcionario.edit",$funcionario->id))->assertStatus(200);

    }
    public function test_update(){

        // Recupera o funcionario recém-criado
        $funcionario = Funcionario::factory()->create();
        $endereco = Endereco::factory()->create();
        $endereco->funcionario_id = $funcionario->id;
        $endereco->save();
        // Testa o update
        $updateDataFuncionario = Funcionario::factory()->make()->toArray();
        $updateDataEndereco = Endereco::factory()->make()->toArray();
        $updateData =  array_merge($updateDataFuncionario, $updateDataEndereco);
        $this->put(route("funcionario.update",$funcionario->id), $updateData)
            ->assertStatus(302); // supondo redirecionamento ao salvar

    }
    public function test_destroy(){

        // Recupera o funcionario recém-criado
        $funcionario = Funcionario::factory()->create();
        // Acessando show
        $this->delete(route("funcionario.destroy", $funcionario->id))->assertStatus(302);

    }

}
