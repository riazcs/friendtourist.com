<?php

namespace App\Jobs;

use App\Events\SendOTPSMSEvent;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendOTPSMSJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $mask;
    protected $phone;
    protected $text;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($mask, $phone, $text)
    {
        $this->mask = $mask;
        $this->phone = $phone;
        $this->text = $text;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        event(new SendOTPSMSEvent($this->mask, $this->phone, $this->text));
    }
}
