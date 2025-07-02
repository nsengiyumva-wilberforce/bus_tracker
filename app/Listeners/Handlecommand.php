<?php

namespace App\Listeners;

use App\Events\MessageReceived;
use FlyService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Str;

class Handlecommand
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        
    }

    /**
     * Handle the event.
     */
    public function handle(MessageReceived $event): void
    {
        $message  = json_decode($event->message);

        if(! $message->event || Str::startsWith($message->event, 'client-')) {
            return;
        }

        $command = Str::after($message->event, 'client-');

        app(FlyService::class)->send($command);
    }
}
