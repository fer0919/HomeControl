<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Adafruit extends Model
{
    use HasFactory;
    protected $table = "adafruit";
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'feed_id',
        'group_id',
        'serial',
    ];
}
