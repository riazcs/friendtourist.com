<?php

namespace App\Models;

use App\Traits\HasActivityTrait;
use App\Traits\HasFacilityTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Amenity extends Model
{
    use SoftDeletes;
    use HasFactory;
    use HasActivityTrait;
    use HasFacilityTrait;


    const AmenityTypes = [
        'Hotel' => 1,
        'Room' => 2
    ];
    protected $table = 'amenities';
    protected $fillable = [
        'name',
        'parent_id',
        'type'
    ];

    public function parent()
    {
        return $this->belongsTo(Amenity::class, 'parent_id', 'id');
    }

    public function children(){
        return $this->hasMany(Amenity::class, 'parent_id', 'id');
    }
}
