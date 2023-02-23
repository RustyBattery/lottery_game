<?php

namespace App\Events;

use App\Models\LotteryGame;
use App\Models\LotteryGameMatch;
use App\Models\User;

class LotteryMatchJoin extends Event
{
    public $user;
    public $match;
    public $count_users;
    public $limit_users;

    public function __construct(User $user, LotteryGameMatch $match)
    {
        $this->user = $user;
        $this->match = $match;
        $game = $match->game;
        $this->limit_users = $game->gamer_count;
        $this->count_users = $match->users->count();
    }
}
