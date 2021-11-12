<?php

namespace App\Models;

use App\Traits\HasActivityTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favourite extends Model
{
    use HasFactory;
    use HasActivityTrait;
    protected $table = 'favourites';
    protected $fillable = [
        'hotel_id',
        'user_id',
        'created_at',
        'updated_at'
    ];

}
