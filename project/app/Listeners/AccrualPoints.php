<?php

namespace App\Listeners;

use App\Events\ExampleEvent;
use App\Events\LotteryMatchFinished;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class AccrualPoints
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
        $winner = User::query()->findOrFail($event->match->winner_id);
        $points = $event->match->game->reward_points;
        $winner->points += $points;
        $winner->save();
    }
}
