<?php

namespace App\Http\Controllers;

use App\Exceptions\CustomException;
use App\Http\Controllers\Requests\UserCreateRequest;
use App\Http\Controllers\Requests\UserUpdateRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        $users = collect($users)->map(function ($user) {
            $user->win_matches = $user->win_matches->where('winner_id', $user->id);
            return $user;
        });
        return response($users, 200);
    }

    public function create(UserCreateRequest $request)
    {
        $data = $request->getParams()->toArray();
        $data['password'] = Hash::make($data['password']);
        $user = User::create($data);
        return response("OK", 200);
    }

    public function update(UserUpdateRequest $request, $id)
    {
        $data = $request->getParams()->toArray();
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
