<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;
    protected $fillable = [
        'branch_id',
        'cinema_id',
        'type_room_id',
        'name',
        'capacity',
        'is_active',
    ];
    protected $cast = [
        'is_active'=>'boolean'
    ];

    const CAPACITIESS =[ // Sức chứa
        130 ,
        150,
        170
    ];
    const ROW_SEAT_REGULAR = 4;
    const MAX_ROW = 15;
    const MAX_COL = 15;

    public function cinema(){
        return $this->belongsTo(Cinema::class);
    }

    public function typeRoom(){
        return $this->belongsTo(TypeRoom::class);
    }
    public function branch(){
        return $this->belongsTo(Branch::class);
    }
    public function seats(){
        return $this->hasMany(Seat::class);
    }


    public function showtimes()
    {
        return $this->hasMany(Showtime::class);
    }
}
