<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notificacao extends Model
{
    /** @use HasFactory<\Database\Factories\Models\NotificacaoFactory> */
    use HasFactory;
    public $table = 'notificacao';
    protected $fillable = ['titulo', 'mensagem', 'cliente_id'];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'cliente_id');
    }

}
