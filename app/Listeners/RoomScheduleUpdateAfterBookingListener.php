<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class RoomScheduleUpdateAfterBookingListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        foreach ($event->booking->booked_rooms as $booked_room){
            $notSold = $booked_room->schedule->not_sold - $booked_room->room_qty;
            Log::info($notSold);
            $booked_room->schedule()->update([
                'not_sold'=>$notSold
            ]);
        }
    }
}
