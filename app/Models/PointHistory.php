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
    public function membership(){
        return $this->belongsTo(Membership::class); 
    }
}
