<?php

namespace App\Models;

use App\Events\LotteryMatchFinished;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class LotteryGameMatch extends Model
{
    use HasFactory;

    protected $fillable = [
        'game_id', 'start_date', 'start_time', 'winner_id'
    ];

    public function game(): BelongsTo
    {
        return $this->belongsTo(LotteryGame::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'lottery_game_match_users')->using(UserMatch::class)->withTimestamps();
    }
}
