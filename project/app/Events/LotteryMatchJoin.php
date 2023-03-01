<?php

namespace App\Events;

use App\Models\LotteryGame;
use App\Models\LotteryGameMatch;
use App\Models\User;
use App\Models\UserMatch;

class LotteryMatchJoin extends Event
{
    public $user;
    public $match;
    public $count_users;
    public $limit_users;

    public function __construct(UserMatch $user_match)
    {
        $this->user = User::query()->findOrFail($user_match->user_id);
        $this->match = LotteryGameMatch::query()->findOrFail($user_match->lottery_game_match_id);
        $game = $this->match->game;
        $this->limit_users = $game->gamer_count;
        $this->count_users = $this->match->users->count();
    }
}
