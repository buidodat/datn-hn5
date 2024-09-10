<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seat extends Model
{
    use HasFactory;
    protected $fillable = [
        'room_id',
        'type_seat_id',
        'coordinates_x',
        'coordinates_y',
        'is_active',
    ];
    protected $cast = [
        'is_active'=>'boolean'
    ];
}
