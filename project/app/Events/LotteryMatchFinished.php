<?php

namespace App\Events;

use App\Models\LotteryGameMatch;

class LotteryMatchFinished extends Event
{
    public $match;

    public function __construct(LotteryGameMatch $match)
    {
        $this->match = $match;
    }
}
