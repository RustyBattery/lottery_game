<?php

namespace App\Console\Commands;

use App\Models\LotteryGameMatch;
use Carbon\Carbon;
use Illuminate\Console\Command;

class FinishMatch extends Command
{
    protected $signature = 'match:finish';

    protected $description = 'Finish inactive matches';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $matches = LotteryGameMatch::query()
            ->where(function ($query) {
                $query->whereDate('start_date', '<', Carbon::now()->addHours(7))
                    ->orWhere(function ($query) {
                        $query->whereDate('start_date', '=', Carbon::now()->addHours(7))
                            ->whereTime('start_time', '<', Carbon::now()->addHours(7));
                    });
            })
            ->where('is_finished', false)->get();

        foreach ($matches as $match){
            $match->finish();
        }
    }
}
