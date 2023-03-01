<?php

namespace App\Http\Controllers\Requests;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GameIdRequest extends Controller
{
    public function __construct(Request $request)
    {
        $this->validate(
            $request, [
                'lottery_game_id' => 'required|exists:lottery_games,id',
            ]
        );

        parent::__construct($request);
    }
}
