<?php

namespace App\Models;

use App\Traits\HasActivityTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RoomBed extends Model
{
    use HasFactory;
    use HasActivityTrait;
    use SoftDeletes;

    protected $table='room_beds';

    protected $fillable=[
        'room_id',
        'bed_type',
        'bed_size',
    ];

    public function room()
    {
        return $this->belongsTo(Room::class, 'room_id', 'id');
    }

}
