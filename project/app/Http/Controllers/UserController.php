<?php

namespace App\Http\Controllers;

use App\Exceptions\CustomException;
use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with(['matches' => function ($query){
            $query->whereColumn('lottery_game_matches.winner_id', 'lottery_game_match_users.user_id');
        }])->get();
        return response($users, 200);
    }

    public function create(UserCreateRequest $request)
    {
        $data = $request->validated();
        $data['password'] = Hash::make($data['password']);
        $user = User::create($data);
        return response("OK", 200);
    }

    public function update(UserUpdateRequest $request, $id)
    {
        $data = $request->validated();
        $data['password'] = Hash::make($data['password']);
        auth()->user()->update($data);
        return response("OK", 200);
    }

    public function delete($id)
    {
        auth()->user()->delete();
        return response("OK", 200);
    }
}
