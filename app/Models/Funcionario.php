<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class Funcionario extends Model
{
    /** @use HasFactory<\Database\Factories\FuncionarioFactory> */
    use HasFactory;


    public $table = 'funcionario';
    protected $fillable = ['nome', 'email', 'cargo','telefone', 'empresa_id', 'user_id'];

    public function empresa(){
        return $this->belongsTo(Empresa::class, 'empresa_id');
    }

    public function chats(){
        return $this->belongsToMany(Chat::class, 'funcionarioChat', 'funcionario_id', 'chat_id');
    }

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }
    public function enderecos()
    {
        return $this->hasOne(Endereco::class, 'funcionario_id');
    }

}
