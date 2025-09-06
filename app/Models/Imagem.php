<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Imagem extends Model
{
    /** @use HasFactory<\Database\Factories\Models\ImagemFactory> */
    use HasFactory;
    public $table = 'imagem';
    protected $fillable = ['cliente_id', 'caminho', 'funcionario_id', 'user_id'];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class,'cliente_id');
    }
    public function funcionario()
    {
        return $this->belongsTo(Funcionario::class,'funcionario_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }

}
