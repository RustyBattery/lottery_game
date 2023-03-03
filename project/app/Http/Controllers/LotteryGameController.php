<?php

namespace App\Http\Controllers;

use App\Models\LotteryGame;

class LotteryGameController extends Controller
{
    public function index()
    {
        $lottery_games = LotteryGame::with('matches')->get();
        return response($lottery_games, 200);
    }
}
