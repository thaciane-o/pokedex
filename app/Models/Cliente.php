<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    /** @use HasFactory<\Database\Factories\Models\ClienteFactory> */
    use HasFactory;
    public $table = 'cliente';
    protected $fillable = ['nome', 'telefone', 'email', 'empresa_id'];

    public function empresa()
    {
        return $this->belongsTo(Empresa::class,'empresa_id');
    }

    public function endereco()
    {
        return $this->hasOne(Endereco::class, 'endereco_id');
    }

    public function chats()
    {
        return $this->hasOne(Chat::class,'chat_id');
    }

}
