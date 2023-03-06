<?php

namespace App\Jobs;

use App\Models\LotteryGameMatch;

class MatchFinishJob extends Job
{
    protected $match;

    public function __construct(LotteryGameMatch $match)
    {
        $this->match = $match;
    }

    public function handle()
    {
        $this->match->finish();
    }
}
