<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grupo_Usuario extends Model
{
    use HasFactory;
    protected $table = "grupos_usuarios";
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'fk_usuario',
        'fk_grupo',
    ];
}
