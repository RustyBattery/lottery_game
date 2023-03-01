<?php

namespace App\Listeners;

use App\Events\ExampleEvent;
use App\Events\LotteryMatchJoin;
use App\Exceptions\CustomException;
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
        if ($event->count_users >= $event->limit_users) {
            throw new CustomException("The user limit is exhausted!", 400);
        }
    }
}
