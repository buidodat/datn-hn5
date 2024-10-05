<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
        'is_active',
    ];
    protected $cast = [
        'is_active'=>'boolean'
    ];
    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }
}
