<?php

namespace App\Models;

use App\Traits\HasActivityTrait;
use App\Traits\HasAttachmentTrait;
use App\Traits\HasFacilityTrait;
use App\Traits\HasFilterTrait;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Room extends Model
{
    use HasFactory;
    use HasActivityTrait;
    use HasAttachmentTrait;
    use SoftDeletes;
    use HasFacilityTrait;
    use HasFilterTrait;

    protected $table="rooms";

    protected $fillable=[
        'hotel_id',
        'room_type',
        'room_character',
        'room_view',
        'room_name',
        'smoking_policy',
        'total_rooms',
        'adult_occupancy',
        'child_occupancy',
        'extra_bed',
        'max_guest_allow',
        'room_size',
        'rack_price',
        'status'
    ];

    protected $appends=[
        'amenities'
    ];

    public function getAmenitiesAttribute()
    {
        $ids = $this->facilities()->pluck('id');
        return Amenity::where('parent_id', null)
            ->whereHas('children', function ($q) use ($ids){
                return $q->whereIn('id', $ids);
            })
            ->with(['children'=> function ($q) use ($ids){
                return $q->whereIn('id', $ids);
            }])
            ->get();
    }

    public function scopeFindRooms($query, $adult, $checkin, $checkout, $rooms=1)
    {
        $adult = empty($adult)? 2: $adult;
        $rooms = empty($rooms)? 1: $rooms;
        $checkin = empty($checkin)? Carbon::now(): $checkin;
        $checkout = empty($checkout)? Carbon::tomorrow(): $checkout;
        return $query->isActive()
            ->where('max_guest_allow' , '>=' , ceil($adult/$rooms))
            ->whereHas('schedules' , function ($query) use ($checkin , $checkout, $rooms){
                return $query->isActive()
                    ->where('start_date', '<=' , $checkin)
                    ->where('end_date' , '>=' , $checkout )
                    ->where('not_sold', '>=', $rooms)
                    ->groupBy('board_type')
                    ->latest();
            });
    }

    public function hotel()
    {
        return $this->belongsTo(Hotel::class, 'hotel_id', 'id');
    }

    public function beds()
    {
        return $this->hasMany(RoomBed::class, 'room_id', 'id');
    }

    public function schedules()
    {
        return $this->hasMany(RoomSchedule::class, 'room_id', 'id');
    }

    public function schedule()
    {
        return $this->hasOne(RoomSchedule::class, 'room_id', 'id')
            ->isActive()
            ->latest();
    }

    public function booked_rooms()
    {
        return $this->hasMany(BookedRoom::class, 'room_id', 'id');
    }
}
