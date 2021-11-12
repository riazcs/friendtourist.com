<?php

namespace App\Models;

use App\Traits\HasActivityTrait;
use App\Traits\HasFilterTrait;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RoomSchedule extends Model
{
    use HasFactory;
    use SoftDeletes;
    use HasActivityTrait;
    use HasFilterTrait;


    const Refundable=[
        'Yes'=>1,
        'No'=>0
    ];

    const Status=[
        'Open'=>1,
        'Close'=>0
    ];
    const BoardType=[
        'None'=>0,
        'Bed and Breakfast'=>1,
        'Half Board'=>2,
        'Full Board'=>3,
    ];

    const Days = [
        'Saturday' => 1,
        'Sunday' => 2,
        'Monday' => 3,
        'Tuesday' => 4,
        'Wednesday' => 5,
        'Thursday' => 6,
        'Friday' => 7
    ];


    const ServiceCharge = 0.1; // 10%;
    const Tav = .15; // 15%;

    protected $table='room_schedules';

    protected $fillable=[
        'hotel_id',
        'room_id',
        'start_date',
        'end_date',
        'board_type',
        'refundable',
        'status',
        'available_room',
        'not_sold',
        'bar_rate',
    ];
    protected $appends=[
        'board_label',
        'discount_percent',
        'service_charge',
        'total_tax',
        'total_charge'
    ];

    public function getBoardLabelAttribute()
    {
        $type = array_flip(self::BoardType);
        return $type[$this->attributes['board_type']];
    }

    public function getDiscountPercentAttribute()
    {
        $discount = (100 * ( $this->room->rack_price - $this->attributes['bar_rate']) / $this->room->rack_price);

        return $discount>0? number_format($discount,0): 0;
    }

    public function getServiceChargeAttribute()
    {
        return $this->attributes['bar_rate'] * (($this->room->hotel->service_charge??0)/100);
    }

    public function getTotalTaxAttribute()
    {
        return  ($this->attributes['bar_rate'] + $this->getServiceChargeAttribute()) * self::Tav;
    }

    public function getTotalChargeAttribute()
    {
        return  ($this->getServiceChargeAttribute() + $this->getTotalTaxAttribute()) ;
    }

    public function scopeFindAvailableRooms($query, $checkin, $checkout, $rooms)
    {
        $rooms = empty($rooms)? 1: $rooms;
        $checkin = empty($checkin)? Carbon::now(): $checkin;
        $checkout = empty($checkout)? Carbon::tomorrow(): $checkout;

        return $query->where('start_date', '<=' , $checkin)
                    ->where('end_date' , '>=' , $checkout )
                    ->where('not_sold', '>=', $rooms)
                    ->groupBy('board_type');
    }

    public function scopeFindSchedule($query,$adult, $checkin, $checkout, $rooms)
    {
        $adult = empty($adult)? 2: $adult;
        $rooms = empty($rooms)? 1: $rooms;
        $checkin = empty($checkin)? Carbon::now(): $checkin;
        $checkout = empty($checkout)? Carbon::tomorrow(): $checkout;

        return $query->where('start_date', '<=' , $checkin)
            ->where('end_date' , '>=' , $checkout )
            ->where('not_sold', '>=', $rooms)
            ->whereHas('room', function ($qu) use ($adult, $rooms){
                return $qu->where('max_guest_allow' , '>=' , ceil($adult/$rooms))->isActive();
            });
    }
    public function scopeReCheckSchedule($query, $checkin, $checkout, $rooms)
    {
        $rooms = empty($rooms)? 1: $rooms;
        $checkin = empty($checkin)? Carbon::now(): $checkin;
        $checkout = empty($checkout)? Carbon::tomorrow(): $checkout;

        return $query->where('start_date', '<=' , $checkin)
            ->where('end_date' , '>=' , $checkout )
            ->where('not_sold', '>=', $rooms);
    }

    public function room()
    {
        return $this->belongsTo(Room::class, 'room_id', 'id');
    }

    public function hotel()
    {
        return $this->belongsTo(Hotel::class, 'hotel_id', 'id');
    }

    public function booked_rooms()
    {
        return $this->hasMany(BookedRoom::class, 'schedule_id', 'id');
    }
}
