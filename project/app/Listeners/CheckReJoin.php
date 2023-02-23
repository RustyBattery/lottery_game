<?php

namespace App\Listeners;

use App\Events\ExampleEvent;
use App\Events\LotteryMatchJoin;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class CheckReJoin
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
     * @param \App\Events\LotteryMatchJoin $event
     * @return void
     */
    public function handle(LotteryMatchJoin $event)
    {
        $matches = $event->user->matches;
        foreach ($matches as $match) {
            if ($match->pivot->user_id == $event->user->id && $match->pivot->lottery_game_match_id == $event->match->id) {
                return [false, "This user has already joined!"];
            }
        }
        return [true];
    }
}
