<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Membership extends Model
{
    use HasFactory;
    public $fillable = [
        'user_id',
        'code',
        'rank',
        'points',
        'total_spent',
    ];

    public static function  codeMembership() {
        $codes = Membership::pluck('code')->toArray();
        do {
            $code = str_pad(rand(0, 999999999999), 12, '0', STR_PAD_LEFT);
        } while (in_array($code, $codes));
        return $code;
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function pointHistories(){
        return $this->hasMany(PointHistory::class);
    }
}
