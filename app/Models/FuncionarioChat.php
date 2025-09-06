<?php

namespace App\Models;

use App\Models\Chat;
use App\Models\Funcionario;
use Illuminate\Database\Eloquent\Model;

class FuncionarioChat extends Model
{
    public $table = "funcionarioChat";


    public function funcionario(){
        return $this->belongsTo(Funcionario::class, 'funcionario_id');
    }
    public function chat(){
        return $this->belongsTo(Chat::class, 'chat_id');
    }
}
