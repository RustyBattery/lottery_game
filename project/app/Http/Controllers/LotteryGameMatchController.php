<?php

namespace App\Http\Controllers;


use App\Events\LotteryMatchFinished;
use App\Events\LotteryMatchJoin;
use App\Models\LotteryGame;
use App\Models\LotteryGameMatch;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Event;

class LotteryGameMatchController extends Controller
{
    public function index(Request $request)
    {
        $data = $this->validate($request, [
            'lottery_game_id' => 'required|exists:lottery_games,id',
        ]);
        $mathes = LotteryGame::query()->find($data['lottery_game_id'])->matches;
        return $mathes;
    }

    public function create(Request $request)
    {
        $data = $this->validate($request, [
            'game_id' => 'required|exists:lottery_games,id',
            'start_date' => 'required|after_or_equal:today',
            'start_time' => 'date_format:H:i',
            'winner_id' => 'nullable|exists:users,id',//проверка на тех, кто присоединился
            'is_finished' => 'nullable|boolean',
        ]);
        $match = LotteryGameMatch::create($data);
        return response("OK", 200);
    }

    public function finish(Request $request)
    {
        $data = $this->validate($request, [
            'id' => 'required|exists:lottery_game_matches,id',
        ]);
        $match = LotteryGameMatch::find($data['id']);
        if (!$match) {
            return response("This match does not exist!", 404);
        }
        if ($match->is_finished == true) {
            return response("The match is already finished!", 400);
        }
        $match->is_finished = true;
        $match->save();

        Event::dispatch(new LotteryMatchFinished($match));

        return response("OK", 200);
    }

    public function join(Request $request)
    {
        $user = User::query()->find(auth()->user()->id);
        $data = $this->validate($request, [
            'match_id' => 'required|integer|exists:lottery_game_matches,id',
        ]);

        $match = LotteryGameMatch::find($data['match_id']);//delete

        $checks = Event::dispatch(new LotteryMatchJoin($user, $match));
        foreach ($checks as $check) {
            if ($check[0] == false) {
                return response($check[1], 400);
            }
        }

        $user->matches()->attach($data['match_id']);
        return response("OK", 200);
    }
}
