<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Luminosidad extends Model
{
    use HasFactory;
    protected $table = "feed_luminosidad";
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'feed_id',
        'value',
    ];
    public $timestamps = true;
}
