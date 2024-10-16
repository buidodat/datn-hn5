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
        'name',
        'is_active',
    ];
    protected $cast = [
        'is_active' => 'boolean'
    ];


    protected $dates = ['deleted_at'];
    // Quan hệ với phòng (Room)
    public function room()
    {
        return $this->belongsTo(Room::class);
    }
    public function ticketSeats()
    {
        return $this->hasMany(TicketSeat::class);
    }
    // Quan hệ với loại ghế (TypeSeat)
    public function typeSeat()
    {
        return $this->belongsTo(TypeSeat::class);
    }
    public function showtimes()
    {
        return $this->belongsToMany(Showtime::class, 'seat_showtimes', 'seat_id', 'showtime_id')
                    ->withPivot('status','price')
                    ->withTimestamps();
    }
}
