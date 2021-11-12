<?php

namespace App\Traits;

use App\Models\Amenity;
use App\Models\Hotel;
use App\Models\Room;

trait HasFacilityTrait
{
    public function facilities()
    {
        return $this->morphToMany(Amenity::class, 'amenityables');
    }


    // Amenity model Relations

    public function hotels()
    {
        return $this->morphedByMany(Hotel::class, 'amenityables');
    }

    public function rooms()
    {
        return $this->morphedByMany(Room::class, 'amenityables');
    }
}
