<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pokemon extends Model
{
    use HasFactory;

    protected $table = 'pokemon';

    protected $fillable = [
        'nome',
        'tipo',
        'foto',
    ];
<<<<<<< HEAD

    protected $casts = [
        'tipo' => 'array',
    ];
=======
    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

>>>>>>> listar-pokemon
}
