<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServoCochera extends Model
{
    use HasFactory;
    protected $table = "feed_servomotor";
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
