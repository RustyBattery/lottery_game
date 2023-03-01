<?php

namespace App\Http\Controllers\Requests;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MatchJoinRequest extends Controller
{
    public function __construct(Request $request)
    {
        $this->validate(
            $request, [
                'match_id' => 'required|exists:lottery_game_matches,id',
            ]
        );

        parent::__construct($request);
    }
}
