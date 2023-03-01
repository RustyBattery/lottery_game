<?php

namespace App\Http\Controllers\Requests;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MatchIdRequest extends Controller
{
    public function __construct(Request $request)
    {
        $this->validate(
            $request, [
                'id' => 'required|exists:lottery_game_matches,id',
            ]
        );

        parent::__construct($request);
    }
}
