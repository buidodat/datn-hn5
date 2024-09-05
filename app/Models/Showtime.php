<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Showtime extends Model
{
    use HasFactory;
    protected $fillable = [
        'room_id',
        'movie_language_id',
        'date',
        'start_time',
        'end_time',
        'is_active',
    ];
    protected $cast = [
        'is_active'=>'boolean'
    ];
}
