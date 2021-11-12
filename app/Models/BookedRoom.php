<?php

namespace App\Models;

use App\Traits\HasActivityTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BookedRoom extends Model
{
    use HasFactory;
    use SoftDeletes;
//    use HasActivityTrait;

    protected $table='booked_rooms';

    protected $fillable=[
        'booking_id',
        'room_id',
        'schedule_id',
        'rack_price',
        'bar_price',
        'room_name',
        'room_qty',
        'room_amenities'
    ];

    public function booking()
    {
        return $this->belongsTo(Booking::class, 'booking_id', 'id');
    }

    public function room()
    {
        return $this->belongsTo(Room::class, 'room_id', 'id');
    }

    public function schedule()
    {
        return $this->belongsTo(RoomSchedule::class, 'schedule_id', 'id');
    }
}
