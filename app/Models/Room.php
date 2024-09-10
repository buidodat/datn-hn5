<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;
    protected $fillable = [
        'cinema_id',
        'type_room_id',
        'name',
        'total_seat',
        'is_active',
    ];
    protected $cast = [
        'is_active'=>'boolean'
    ];

    const TOTAL_SEATS =[
        100,
        150,
        200
    ];

    public function cinema(){
        return $this->belongsTo(Cinema::class);
    }
    public function typeRoom(){
        return $this->belongsTo(TypeRoom::class);
    }
}
