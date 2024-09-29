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
        'matrix_id',
        'row_seat_regular',
        'row_seat_double',
        'is_active',
        'is_publish'
    ];
    protected $cast = [
        'is_active'=>'boolean',
        'is_publish'=>'boolean',
    ];

    const CAPACITIESS = [ // Sức chứa
        130,
        150,
        170
    ];
    const MATRIXS = [
        ['id'=>1,'name'=>'12x12','max_row'=>12,'max_col'=>12],
        ['id'=>2,'name'=>'13x13','max_row'=>13,'max_col'=>13],
        ['id'=>3,'name'=>'14x14','max_row'=>14,'max_col'=>14],
        ['id'=>4,'name'=>'15x15','max_row'=>15,'max_col'=>15]
    ];
    const SCOPE_REGULAR = ['min'=>3,'default'=>4,'max'=>5];
    const SCOPE_DOUBLE = ['min'=>0,'default'=>0,'max'=>2];
    const ROW_SEAT_REGULAR = 4;
    const ROW_SEAT_DOUBLE = 0;
    const MAX_ROW = 15;
    const MAX_COL = 15;

    public function cinema()
    {
        return $this->belongsTo(Cinema::class);
    }

    public function typeRoom()
    {
        return $this->belongsTo(TypeRoom::class);
    }




    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }
    public function seats()
    {
        return $this->hasMany(Seat::class);
    }

    public function showtimes()
    {
        return $this->hasMany(Showtime::class);
    }
}
