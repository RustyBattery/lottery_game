<?php

namespace App\Http\Controllers;

use App\Models\LotteryGame;

class LotteryGameController extends Controller
{
    public function index()
    {
        $lottery_games = LotteryGame::all();
        $lottery_games = collect($lottery_games)->map(function ($lottery_game) {
            $lottery_game->matches = $lottery_game->matches;
            return $lottery_game;
        });

        return response($lottery_games, 200);
    }
}
