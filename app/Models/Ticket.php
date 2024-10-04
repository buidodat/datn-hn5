<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'payment_id',
        'voucher_id',
        'voucher_code',
        'voucher_discount',
        'code',
        'total_price',
        'status',
        'expiry',
        'staff'
    ];
}
