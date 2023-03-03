<?php

namespace App\Listeners;

use App\Events\ExampleEvent;
use App\Events\LotteryMatchJoin;
use App\Exceptions\CustomException;
use App\Models\User;
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
        $user = User::query()->findOrFail($event->user_match->user_id);
        $matches = $user->matches;
        foreach ($matches as $match) {
            if ($match->pivot->user_id == $user->id && $match->pivot->lottery_game_match_id == $event->user_match->lottery_game_match_id) {
                throw new CustomException("This user has already joined!", 400);
            }
        }
    }
}
