<?php

namespace App\Models;

use App\Traits\HasActivityTrait;
use App\Traits\HasAttachmentTrait;
use App\Traits\HasFacilityTrait;
use App\Traits\HasFilterTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;


class Hotel extends Model
{
    use HasFactory;
    use SoftDeletes;
    use HasActivityTrait;
    use HasAttachmentTrait;
    use HasFacilityTrait;
    use HasFilterTrait;


    protected $fillable = [
        'name',
        'user_id',
        'property_type',
        'no_of_rooms',
        'no_of_floors',
        'construction_year',
        'license',
        'website',
        'contact_first_name',
        'contact_last_name',
        'contact_email',
        'contact_phone',
        'contact_designation',
        'contact_department_name',
        'address_line',
        'area',
        'lon',
        'lat',
        'description',
        'rules',
        'no_of_star',
        'child_policy',
        'pet_policy',
        'min_age_child',
        'district_id',
        'check_in_from',
        'check_in_to',
        'check_out_from',
        'check_out_to',
        'status',
        'rules',
        'service_charge',
        'extra_bed_charge'
    ];

    protected $appends=['check_in_time' , 'check_out_time'];


    public  function getCheckInTimeAttribute(){
        return Carbon::parse( $this->attributes['check_in_from'] )->format('h:i A') . " - " . Carbon::parse( $this->attributes['check_in_to'] )->format('h:i A');
    }

    public  function getCheckOutTimeAttribute(){
        return Carbon::parse( $this->attributes['check_out_from'] )->format('h:i A') . " - " . Carbon::parse( $this->attributes['check_out_to'] )->format('h:i A');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function landmarks()
    {
        return $this->hasMany(LandMark::class, 'hotel_id', 'id');
    }

    public function landmark(){
        return $this->hasOne( Landmark::class, 'hotel_id', 'id');
    }

    public function district(){
        return $this->belongsTo(District::class, 'district_id', 'id');
    }

    public function cancels(){
        return $this->hasMany( CancelationPolicy::class , 'hotel_id' , 'id');
    }
    public function rooms()
    {
        return $this->hasMany(Room::class, 'hotel_id', 'id');
    }

    public function faqs()
    {
        return $this->morphMany(Faq::class, 'faqable');
    }
    public function favourites()
    {
        return $this->belongsToMany(User::class, 'favourites');
    }

    public function schedules()
    {
        return $this->hasMany(RoomSchedule::class, 'hotel_id', 'id');
    }

    public function schedule()
    {
        return $this->hasOne(RoomSchedule::class, 'hotel_id', 'id');
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class, 'hotel_id', 'id');
    }

    public function reviews()
    {
        return $this->hasMany(Rating::class, 'hotel_id', 'id');
    }
}
