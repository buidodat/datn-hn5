<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'payment_method',
        'voucher_id',
        'voucher_code',
        'voucher_discount',
        'code',
        'total_price',
        'status',
        'expiry',
        'staff'
    ];

    const STATUS = [
        ['value' => 'pending', 'label' => 'Đang chờ'],
        ['value' => 'confirmed', 'label' => 'Đã xác nhận'],
        ['value' => 'cancelled', 'label' => 'Hủy'],
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function payment()
    {
        return $this->belongsTo(Payment::class);
    }
    public function voucher()
    {
        return $this->belongsTo(Voucher::class);
    }
    public function ticketSeats()
    {
        return $this->hasMany(TicketSeat::class);
    }
    public function ticketCombos()
    {
        return $this->hasMany(TicketCombo::class);
    }
}
