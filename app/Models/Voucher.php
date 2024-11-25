<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Voucher extends Model
{
    use HasFactory;
    protected $fillable = [
        'code',
        'title',
        'description',
        'start_date_time',
        'end_date_time',
        'discount',
        'quantity',
        'limit',
        'is_active',
        'is_publish',
        'type',
    ];
    protected $casts = [
        'is_active'=>'boolean',
        'end_date_time' => 'datetime',
        'start_date_time' => 'datetime',
    ];
    public function users()
    {
        return $this->belongsToMany(User::class, 'user_vouchers')->withTimestamps();
    }
    public function tickets()
    {
        return $this->hasMany(Ticket::class, 'voucher_id');
    }
}
