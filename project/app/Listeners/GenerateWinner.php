<?php

namespace App\Listeners;

use App\Events\ExampleEvent;
use App\Events\LotteryMatchFinished;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class GenerateWinner
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
     * @param \App\Events\LotteryMatchFinished $event
     * @return void
     */
    public function handle(LotteryMatchFinished $event)
    {
        $event->winner = $event->match->users->random();
        $event->match->winner_id = $event->winner->id;
        $event->match->save();
    }
}