<?php

namespace App\Traits;

use Carbon\Carbon;

trait HasFilterTrait
{
    public function scopeIsActive($query)
    {
        return $query->where('status', config('app.status.active'));
    }

    public function scopeFilterHotel($query, $request)
    {

        $adult = 1;
        $child = 0;
        $check_id = Carbon::today();
        $check_out = Carbon::tomorrow();
        if(!empty($request->area)){

        }

        if(!empty($request->adult)){
            $adult = $request->adult;
        }
        if(!empty($request->adult)){
            $child = $request->adult;
        }

        if(!empty($request->check_id)){
            $check_id = Carbon::parse($request->check_id)->format('Y-m-d');
        }

        if(!empty($request->check_out)){
            $check_out = Carbon::parse($request->check_out)->format('Y-m-d');
        }

        $query = $query->whereHas('rooms', function ($q) use ($adult, $child, $check_id, $check_out){
            return $q->where('adult_occupancy', '>=', $adult)
                ->where('child_occupancy', '>=', $child)
                ->whereHas('schedules', function ($sQ) use ($check_id, $check_out){

                });
        });

        return $query;
    }
    public function scopeScheduleFilter($query, $request){

        if(!empty($request->room_ids)){
            $query = $query->whereIn('id', $request->room_ids);
        }

//        if(!empty($request->range)){
//
//        }

        return $query;
    }
}
