<?php

namespace App\Models;

use App\Traits\HasActivityTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Guest extends Model
{
    use HasFactory;
    use SoftDeletes;
//    use HasActivityTrait;

    protected $table='guests';
    protected $fillable=[
        'booking_id',
        'guest_name'
    ];

    public function booking()
    {
        return $this->belongsTo(Booking::class, 'booking_id', 'id');
    }
}
