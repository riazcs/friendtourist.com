<?php

namespace App\Jobs;

use App\Events\BookingStatusUpdateEvent;
use App\Models\Booking;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class BookingStatusUpdateJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $booking;
    protected $message;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Booking $booking, $message)
    {
        $this->booking = $booking;
        $this->message = $message;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        event(new BookingStatusUpdateEvent($this->booking, $this->message));
    }
}
