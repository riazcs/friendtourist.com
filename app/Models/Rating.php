<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Rating extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table='ratings';

    protected $fillable=[
        'hotel_id',
        'user_id',
        'booking_id',
        'hotel_rating',
        'staff_rating',
        'facility_rating',
        'cleanliness_rating',
        'comfort_rating',
        'price_rating',
        'location_rating',
        'review'
    ];

    protected $appends=['overall_rating', 'review_date'];

    public function getOverallRatingAttribute()
    {
        return 0;
    }
    public function getReviewDateAttribute()
    {
        return Carbon::parse($this->attributes['created_at'])->format('d,M Y');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function hotel()
    {
        return $this->belongsTo(Hotel::class, 'hotel_id', 'id');
    }

    public function booking()
    {
        return $this->belongsTo(Booking::class, 'booking_id', 'id');
    }
}
