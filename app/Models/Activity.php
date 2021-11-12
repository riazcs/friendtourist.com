<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Activity extends Model
{
    use HasFactory;
    use SoftDeletes;

    const Types = [
        'Created'=>1,
        'Updated'=>2,
        'Deleted'=>3,
    ];

    protected $table='activities';
    protected $fillable=[
        'user_id',
        'activity_type',
        'activityable_id',
        'activityable_type',
    ];

    /**
     * Get the owning activityable model.
     */
    public function activityable()
    {
        return $this->morphTo();
    }

}
