<?php

namespace App\Http\Requests;


use Anik\Form\FormRequest;

class MatchJoinRequest extends FormRequest
{

    protected function rules(): array
    {
        return [
            'match_id' => 'required|exists:lottery_game_matches,id',
        ];
    }
}
