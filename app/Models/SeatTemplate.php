<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SeatTemplate extends Model
{
    use HasFactory;
    protected $fillable = [
        'matrix_id',
        'name',
        'seat_structure',
        'description',
        'is_active',
        'is_publish'
    ];

    protected $cast = [
        'is_publish' => 'boolean',
        'is_active' => 'boolean',
        'seat_structure' => 'array'
    ];

    const MATRIXS = [
        ['id' => 1, 'name' => '12x12', 'max_row' => 12, 'max_col' => 12],
        ['id' => 2, 'name' => '13x13', 'max_row' => 13, 'max_col' => 13],
        ['id' => 3, 'name' => '14x14', 'max_row' => 14, 'max_col' => 14],
        ['id' => 4, 'name' => '15x15', 'max_row' => 15, 'max_col' => 15],
    ];

    public static function getMatrixById($id)
    {
        return collect(self::MATRIXS)->firstWhere('id', $id);
    }
}
