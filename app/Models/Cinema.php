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
}
