<?php

namespace App\Http\Controllers\Requests;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MatchCreateRequest extends Controller
{
    public function __construct(Request $request)
    {
        $this->validate(
            $request, [
                'game_id' => 'required|exists:lottery_games,id',
                'start_date' => 'required|after_or_equal:today',
                'start_time' => 'date_format:H:i',
                'winner_id' => 'nullable|exists:users,id',
                'is_finished' => 'nullable|boolean',
            ]
        );

        parent::__construct($request);
    }
}
