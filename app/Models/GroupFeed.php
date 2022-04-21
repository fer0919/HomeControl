<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroupFeed extends Model
{
    use HasFactory;
    protected $table = "groups";
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id_grupo',
        'value',
        'feed_temperatura_fk',
        'feed_humedad_fk',
        'feed_ultrasonido_fk',
        'feed_servomotor_fk',
        'feed_luminosidad_fk',
        'feed_humo_fk',    
    ];
    public $timestamps = true;
}

