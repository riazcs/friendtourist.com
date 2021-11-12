<?php

namespace App\Providers;

use App\Events\BookingStatusUpdateEvent;
use App\Events\NewBookingPlaceEvent;
use App\Events\SendOTPSMSEvent;
use App\Listeners\RoomScheduleUpdateAfterBookingListener;
use App\Listeners\SendSMSListener;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        SendOTPSMSEvent::class => [
            SendSMSListener::class
        ],
        NewBookingPlaceEvent::class =>[
            RoomScheduleUpdateAfterBookingListener::class
        ],
        BookingStatusUpdateEvent::class=>[
            // TODO add email and sms listener
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
