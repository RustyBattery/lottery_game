<?php

namespace App\Http\Requests;


use Anik\Form\FormRequest;

class UserCreateRequest extends FormRequest
{

    protected function rules(): array
    {
        return [
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|unique:users|email',
            'is_admin' => 'nullable|boolean',
            'points' => 'nullable|integer',
            'password' => 'required|string',
        ];
    }
}
