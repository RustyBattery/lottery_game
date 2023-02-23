<?php

namespace App\Events;

use App\Models\LotteryGameMatch;

class LotteryMatchFinished extends Event
{
    public $match;
    public $points;
    public $winner;

    public function __construct(LotteryGameMatch $match)
    {
        $this->match = $match;
        $game = $match->game;
        $this->points = $game->reward_points;
    }
}
