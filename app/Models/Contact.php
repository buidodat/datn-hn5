<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_contact',
        'email',
        'phone',
        'title',
        'content',
        'status',
    ];

    const STATUS = [
        'Chưa xử lí',
        'Đã xử lí',
    ];
}
