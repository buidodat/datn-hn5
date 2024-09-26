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
        'is_active',
        'is_hot',
        /*Thiếu nè*/
        /*'is_show_home',
        'is_special'*/
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'is_hot' => 'boolean',
    ];
    const VERSIONS = [
        'Vietsub',
        'Lồng Tiếng',
        'Thuyết Minh'
    ];
    const RATINGS = [
        'P',
        'C13',
        'C16',
        'C18',
        'K'
    ];
    public function movieVersions()
    {
        return $this->hasMany(MovieVersion::class);
    }
    public function movieReview()
    {
        return $this->hasMany(MovieReview::class, 'movie_id');
    }

    public function showtimes()
    {
        return $this->hasMany(Showtime::class);
    }
}
