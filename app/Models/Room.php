<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;
    protected $fillable = [
        'cenima_id',
        'type_room_id',
        'name',
        'total_seat',
        'is_active',
    ];
    protected $cast = [
        'is_active'=>'boolean'
    ];
}
