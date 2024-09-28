<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Showtime extends Model
{
    use HasFactory;
    protected $fillable = [
        'cinema_id',
        'room_id',
        'format',
        'movie_version_id',
        'movie_id',
        'date',
        'start_time',
        'end_time',
        'is_active',
    ];
    protected $cast = [
        'is_active' => 'boolean'
    ];

    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    public function movieVersion()
    {
        return $this->belongsTo(MovieVersion::class);
    }
    public function movie()
    {
        return $this->belongsTo(Movie::class);
    }


    public function seats()
    {
        return $this->belongsToMany(Seat::class, 'seat_showtimes', 'showtime_id', 'seat_id')
            ->withPivot('status')
            ->withTimestamps();
    }

    // Thời gian dọn phòng: 15p
    const CLEANINGTIME = '15';
}
