<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TicketMovie extends Model
{
    use HasFactory;
    protected $fillable = [
        'ticket_id',
        'showtime_id',
        'seat_id',
        'room_id',
        /*'code',*/ //mã từ bảng vé -> lấy từ ticket sang đi
        'price',
    ];
}
