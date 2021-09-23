<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FeesCoins extends Model
{
    protected $fillable = [
        'coins_id','fees','cache_back',
    ];


    public function Coins()
    {
        return $this->belongsTo(Coins::class);

    }//end fo Coins
}
