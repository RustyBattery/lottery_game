<?php

namespace App\Providers;

use App\Events\LotteryMatchJoin;
use App\Listeners\CheckCountJoin;
use Laravel\Lumen\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        \App\Events\LotteryMatchJoin::class => [
            \App\Listeners\CheckReJoin::class,
            \App\Listeners\CheckCountJoin::class,
        ],
        \App\Events\LotteryMatchFinished::class => [
            \App\Listeners\GenerateWinner::class,
            \App\Listeners\AccrualPoints::class,
        ],
        \App\Events\LotteryMatchCreate::class => [
            \App\Listeners\AddMatchFinishJob::class,
        ],
    ];

    /**
     * Determine if events and listeners should be automatically discovered.
     *
     * @return bool
     */
    public function shouldDiscoverEvents()
    {
        return false;
    }
}
