<?php

namespace App\Listeners;


use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;
use Ixudra\Curl\Facades\Curl;

class SendSMSListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        $response = Curl::to('https://api.boom-cast.com/boomcast/WebFramework/boomCastWebService/externalApiSendTextMessage.php')
            ->withData(array(
                'masking' => $event->mask,
                'userName' => 'BanglaPuzzle',
                'password' => "1cead65604d32b4102a7d3c024760d46",
                'receiver' => $event->phone,
                'MsgType' => 'TEXT',
                'message' => $event->text,
            ))->get();
        Log::info($response);

    }
}
