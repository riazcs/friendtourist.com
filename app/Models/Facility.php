<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Facility extends Model
{
    use HasFactory;
    protected $fillable = [
        'amenity_id',
        'facilityable_id',
        'facilityable_type',
    ];
    public function faciltyable()
    {
        return $this->morphTo();
    }
}
