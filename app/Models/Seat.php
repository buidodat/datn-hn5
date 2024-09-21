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

    // Quan hệ với phòng (Room)
    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    // Quan hệ với loại ghế (TypeSeat)
    public function typeSeat()
    {
        return $this->belongsTo(TypeSeat::class);
    }

    // Quan hệ với lịch chiếu qua bảng trung gian seat_showtimes
    public function showTimes()
    {
        return $this->belongsToMany(ShowTime::class, 'seat_showtimes')
            ->withPivot('status') // Trạng thái ghế tại suất chiếu
            ->withTimestamps();   // created_at và updated_at
    }
}
