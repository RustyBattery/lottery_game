<?php

namespace App\Listeners;

use App\Events\ExampleEvent;
use App\Events\LotteryMatchJoin;
use App\Exceptions\CustomException;
use App\Models\LotteryGameMatch;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class CheckCountJoin
{

    public function __construct()
    {
        //
    }

    public function handle(LotteryMatchJoin $event)
    {
        $match = LotteryGameMatch::query()->findOrFail($event->user_match->lottery_game_match_id);
        $game = $match->game;
        $limit_users = $game->gamer_count;
        $count_users = $match->users->count();
        if ($count_users >= $limit_users) {
            throw new CustomException("The user limit is exhausted!", 400);
        }
    }
}
