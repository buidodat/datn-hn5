<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SeatShowtime extends Model
{
    use HasFactory;
    protected $fillable = [
        'seat_id',
        'showtime_id',
        'status',
        'price'
    ];
}
