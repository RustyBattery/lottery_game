<?php

namespace App\Http\Controllers;

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

    public function create(Request $request)
    {
        $data = $this->validate($request, [
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|unique:users|email',
            'is_admin' => 'nullable|boolean',
            'points' => 'nullable|integer',
            'password' => 'required|string'
        ]);
        $data['password'] = Hash::make($data['password']);

        $user = User::create($data);
        return response("OK", 200);
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);
        if (!$user) {
            return response("This user does not exist!", 404);
        }
        if ($user != auth()->user()) {
            return response("The user is not the account owner!", 403);
        }
        $data = $this->validate($request, [
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'is_admin' => 'nullable|boolean',
            'points' => 'nullable|integer',
            'password' => 'required|string'
        ]);
        $data['password'] = Hash::make($data['password']);
        $user = $user->update($data);
        return response("OK", 200);
    }

    public function delete($id)
    {
        $user = User::find($id);
        if (!$user) {
            return response("This user does not exist!", 404);
        }
        if ($user != auth()->user()) {
            return response("The user is not the account owner!", 403);
        }
        $user->delete();
        return response("OK", 200);
    }
}
