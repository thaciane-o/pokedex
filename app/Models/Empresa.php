<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    /** @use HasFactory<\Database\Factories\Models\EmpresaFactory> */
    use HasFactory;
    public $table = 'empresa';
    protected $fillable = ['nome', 'cnpj', 'telefone', 'email'];

    public function funcionarios()
    {
        return $this->hasMany(Funcionario::class, 'funcionario_id');
    }

    public function clientes()
    {
        return $this->hasMany(Cliente::class, 'cliente_id');
    }
    public function enderecos()
    {
        return $this->hasMany(Endereco::class, 'empresa_id');
    }

}
