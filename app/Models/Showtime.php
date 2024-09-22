<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Showtime extends Model
{
    use HasFactory;
    protected $fillable = [
        'room_id',
        'movie_version_id',
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

    // Thời gian dọn phòng: 15p
    const CLEANINGTIME = '15';
}
