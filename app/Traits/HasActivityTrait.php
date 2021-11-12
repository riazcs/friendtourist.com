<?php

namespace App\Traits;

use App\Models\Activity;

trait HasActivityTrait
{
    public function activities()
    {
        return $this->morphMany(Activity::class, 'activityable')->latest();
    }


    protected static function bootHasActivityTrait()
    {
        self::created(function ($model) {
            $model->activities()->create([
                'user_id'=>auth()->id(),
                'activity_type'=> Activity::Types['Created']
            ]);
        });
        self::saved(function ($model) {
            $model->activities()->create([
                'user_id'=>auth()->id(),
                'activity_type'=> Activity::Types['Created']
            ]);
        });
        self::updated(function ($model) {
            $model->activities()->create([
                'user_id'=>auth()->id(),
                'activity_type'=> Activity::Types['Updated']
            ]);
        });
        self::deleted(function ($model) {
            $model->activities()->create([
                'user_id'=>auth()->id(),
                'activity_type'=> Activity::Types['Deleted']
            ]);
        });
    }
}
