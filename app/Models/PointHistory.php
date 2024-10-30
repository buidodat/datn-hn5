<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PointHistory extends Model
{
    use HasFactory;
    public $fillable = [
        'membership_id',
        'points',
        'type',
        'expiry_date',
    ];

    const POINTS_ACCUMULATED = 'Tích điểm'; // Tích điểm
    const POINTS_SPENT = 'Tiêu điểm';             // Tiêu điểm
    const POINTS_EXPIRY = 'Hết hạn';            // Hết hạn



    public function membership(){
        return $this->belongsTo(Membership::class);
    }
}
