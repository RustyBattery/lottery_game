<?php

namespace App\Listeners;

use App\Events\LotteryMatchCreate;
use App\Jobs\MatchFinishJob;
use Carbon\Carbon;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Queue;

class AddMatchFinishJob
{

    public function __construct()
    {
        //
    }

    public function handle(LotteryMatchCreate $event)
    {
        $datetime = Carbon::create($event->match->start_date.$event->match->start_time)->subHours(7);
        Queue::later($datetime, new MatchFinishJob($event->match));
    }
}
