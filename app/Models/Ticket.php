<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'cinema_id',
        'room_id',
        'movie_id',
        'payment_name',
        'voucher_code',
        'voucher_discount',
        'code',
        'total_price',
        'status',
        'expiry',
        'staff'
    ];

    const STATUS = [
        ['value' => 'pending', 'label' => 'Chưa suất vé'],
        ['value' => 'confirmed', 'label' => 'Đã suất vé'],
        ['value' => 'cancelled', 'label' => 'Đã hết hạn'],
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

    // Sơn sửa lại qh model
    public function cinema()
    {
        return $this->belongsTo(Cinema::class);
    }

    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    public function movie()
    {
        return $this->belongsTo(Movie::class);
    }
}
