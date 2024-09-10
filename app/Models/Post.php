<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'slug',
        'img_post',
        'description',
        'content',
        'is_active',
    ];
    protected $cast = [
        'is_active'=>'boolean'
    ];
}
