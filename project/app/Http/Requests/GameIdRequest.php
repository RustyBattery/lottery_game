<?php

namespace App\Http\Requests;


use Anik\Form\FormRequest;

class GameIdRequest extends FormRequest
{

    protected function rules(): array
    {
        return [
            'lottery_game_id' => 'required|exists:lottery_games,id',
        ];
    }
}
