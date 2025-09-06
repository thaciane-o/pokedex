<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Endereco extends Model
{
    /** @use HasFactory<\Database\Factories\Models\EnderecoFactory> */
    use HasFactory;
    public $table = 'endereco';
    protected $fillable = ['cliente_id', 'numero','rua', 'bairro', 'cidade', 'estado', 'cep', 'complemento','funcionario_id','cliente_id','empresa_id'];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'cliente_id');
    }
    public function funcionario()
    {
        return $this->belongsTo(Funcionario::class, 'funcionario_id');
    }
    public function empresa()
    {
        return $this->belongsTo(Empresa::class, 'empresa_id');
    }

}
