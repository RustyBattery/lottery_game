<?php

namespace App\Http\Requests;


use Anik\Form\FormRequest;

class MatchCreateRequest extends FormRequest
{

    protected function rules(): array
    {
        return [
            'game_id' => 'required|exists:lottery_games,id',
            'start_date' => 'required|after_or_equal:today',
            'start_time' => 'date_format:H:i',
            'winner_id' => 'nullable|exists:users,id',
            'is_finished' => 'nullable|boolean',
        ];
    }
}
