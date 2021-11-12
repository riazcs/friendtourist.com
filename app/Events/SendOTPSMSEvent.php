<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class SendOTPSMSEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $mask;
    public $phone;
    public $text;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($mask, $phone, $text)
    {
        $this->mask = $mask;
        $this->phone = $phone;
        $this->text = $text;

    }
}
