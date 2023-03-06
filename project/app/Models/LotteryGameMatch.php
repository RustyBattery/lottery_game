<?php

namespace App\Models;

use App\Events\LotteryMatchCreate;
use App\Events\LotteryMatchFinished;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Event;

class LotteryGameMatch extends Model
{
    use HasFactory;

    protected $dispatchesEvents = [
        'created' => LotteryMatchCreate::class,
    ];

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

    public function finish(){
        $this->is_finished = true;
        $this->save();
        Event::dispatch(new LotteryMatchFinished($this));
    }
}
