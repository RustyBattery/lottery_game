<?php

namespace App\Events;

use App\Models\UserMatch;

class LotteryMatchJoin extends Event
{
    public $user_match;

    public function __construct(UserMatch $user_match)
    {
        $this->user_match = $user_match;
    }
}
