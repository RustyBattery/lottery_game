<?php

namespace App\Http\Requests;


use Anik\Form\FormRequest;

class MatchIdRequest extends FormRequest
{

    protected function rules(): array
    {
        return [
            'id' => 'required|exists:lottery_game_matches,id',
        ];
    }
}
