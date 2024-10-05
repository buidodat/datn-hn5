<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TicketSeat extends Model
{
    use HasFactory;
    protected $fillable = [
        'ticket_id',
        'showtime_id',
        'seat_id',
        'room_id',
        'movie_id',
        'price',
    ];
    public function ticket()
    {
        return $this->belongsTo(Ticket::class);
    }
    public function movie()
    {
        return $this->belongsTo(Movie::class);
    }
    public function showtime()
    {
        return $this->belongsTo(Showtime::class);
    }
    public function room()
    {
        return $this->belongsTo(Room::class);
    }
    public function seat()
    {
        return $this->belongsTo(Seat::class);
    }
}