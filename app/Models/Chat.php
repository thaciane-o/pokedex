<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    /** @use HasFactory<\Database\Factories\Models\ChatFactory> */
    use HasFactory;
    public $table = 'chat';
        public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'cliente_id');
    }

    public function funcionario()
    {
        return $this->belongsToMany(Chat::class, 'funcionarioChat', 'chat_id', 'funcionario_id');
    }

    public function mensagens()
    {
        return $this->hasMany(Mensagem::class, 'mensagem_id');
    }

}
