<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'slug',
        'category',
        'img_thumbnail',
        'description',
        'director',
        'cast',
        'rating',
        'duration',
        'release_date',
        'end_date',
        'trailer_url',
        'surcharge',
        'is_active',
        'is_hot',
        /*Thêm 2 cái còn thiếu ở trong migration*/
        'is_show_home',
        'is_special'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'is_hot' => 'boolean',
        'is_show_home' => 'boolean',
        'is_special' => 'boolean',
    ];
    const VERSIONS = [
        ['id' => 1, 'name' => 'Phụ Đề'],
        ['id' => 2, 'name' => 'Lồng Tiếng'],
        ['id' => 3, 'name' => 'Thuyết Minh'],
    ];
    // const RATINGS = [
    //     'P',
    //     'C13',
    //     'C16',
    //     'C18',
    //     'K'
    // ];
    const RATINGS = [
        ['id' => 1, 'name' => 'P', 'description' => 'Phim được phép phổ biến đến người xem ở mọi độ tuổi.'],
        ['id' => 2, 'name' => 'T13', 'description' => 'Phim được phổ biến đến người xem dưới 13 tuổi và có người bảo hộ đi kèm.'],
        ['id' => 3, 'name' => 'T16', 'description' => 'Phim được phổ biến đến người xem từ đủ 13 tuổi trở lên.'],
        ['id' => 4, 'name' => 'T18', 'description' => 'Phim được phổ biến đến người xem từ đủ 16 tuổi trở lên.'],
        ['id' => 5, 'name' => 'K', 'description' => 'Phim được phổ biến đến người xem từ đủ 18 tuổi trở lên.'],
    ];

    public static function getRatingByName($name)
    {
        return collect(self::RATINGS)->firstWhere('name', $name);
    }
    public function movieVersions()
    {
        return $this->hasMany(MovieVersion::class);
    }
    public function movieReview()
    {
        return $this->hasMany(MovieReview::class, 'movie_id');
    }
    // public function ticketSeats()
    // {
    //     return $this->hasMany(TicketSeat::class);
    // }
    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }
    public function showtimes()
    {
        return $this->hasMany(Showtime::class);
    }
}
