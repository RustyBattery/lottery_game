<?php

namespace App\Http\Controllers\Requests;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserUpdateRequest extends Controller
{
    public function __construct(Request $request)
    {
        $this->validate(
            $request, [
                'first_name' => 'required|string',
                'last_name' => 'required|string',
                'is_admin' => 'nullable|boolean',
                'points' => 'nullable|integer',
                'password' => 'required|string'
            ]
        );

        parent::__construct($request);
    }
}
