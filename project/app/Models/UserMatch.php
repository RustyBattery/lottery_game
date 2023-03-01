<?php

namespace App\Models;

use App\Events\LotteryMatchJoin;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\Pivot;

class UserMatch extends Pivot
{
    protected $dispatchesEvents = [
        'creating' => LotteryMatchJoin::class,
    ];

    public function users()
    {
        return $this->belongsTo(User::class);
    }

    public function matches()
    {
        return $this->belongsTo(LotteryGameMatch::class);
    }
}
