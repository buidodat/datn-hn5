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
        'capacity',
        'is_active',
    ];
    protected $cast = [
        'is_active'=>'boolean'
    ];

    const CAPACITIESS =[ // Sức chứa
        130,
        150,
        170
    ];

    public function cinema(){
        return $this->belongsTo(Cinema::class);
    }
    public function typeRoom(){
        return $this->belongsTo(TypeRoom::class);
    }
}
