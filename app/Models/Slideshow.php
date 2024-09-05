<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slideshow extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'img_slideshow',
        'description',
        'route_url',
        'is_active',
    ];
    protected $casts =[
        'is_active'=>'boolean',
    ];
}
