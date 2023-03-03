<?php

namespace App\Http\Controllers;


use App\Events\LotteryMatchFinished;
use App\Exceptions\CustomException;
use App\Http\Requests\GameIdRequest;
use App\Http\Requests\MatchCreateRequest;
use App\Http\Requests\MatchIdRequest;
use App\Http\Requests\MatchJoinRequest;
use App\Models\LotteryGame;
use App\Models\LotteryGameMatch;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Event;

class LotteryGameMatchController extends Controller
{
    public function index(GameIdRequest $request)
    {
        $data = $request->validated();
        $mathes = LotteryGame::query()->find($data['lottery_game_id'])->matches;
        return $mathes;
    }

    public function create(MatchCreateRequest $request)
    {
        $data = $request->validated();
        $match = LotteryGameMatch::create($data);
        return response("OK", 200);
    }

    public function finish(MatchIdRequest $request)
    {
        $data = $request->validated();
        $match = LotteryGameMatch::find($data['id']);
        if (!$match) {
            throw new CustomException("This match does not exist!", 404);
        }
        if ($match->is_finished == true) {
            throw new CustomException("The match is already finished!", 400);
        }

        $match->is_finished = true;
        $match->save();

        Event::dispatch(new LotteryMatchFinished($match));

        return response("OK", 200);
    }

    public function join(MatchJoinRequest $request)
    {
        $user = User::query()->find(auth()->user()->id);
        $data = $request->validated();
        $user->matches()->attach($data['match_id']);
        return response("OK", 200);
    }
}
