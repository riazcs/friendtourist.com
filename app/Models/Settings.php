<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{
    use HasFactory;

    const SettingTypes = [
        'Property Type'=>'property_type',
        'Room Type'=>'room_type',
        'Bed Type'=>'bed_type',
        'Bed Size'=>'bed_size',
        'Room View'=>'room_view',
        'Room Characteristics' => 'room_characteristics'
    ];

    protected $table = 'settings';
    protected $fillable = [
        'name',
        'data', // for string data
        'value' // for integer data
    ];
}
