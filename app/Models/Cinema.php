<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cinema extends Model
{
    use HasFactory;

    protected $fillable = [
        'branch_id',
        'name',
        'slug',
        'address',
        'description',
        'is_active'
    ];
    protected $cast = [
        'is_active'=>'boolean'
    ];

    public function branch(){
        return $this->belongsTo(Branch::class);
    }
    public function rooms(){
        return $this->hasMany(Room::class);
    }
}
