<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Coins extends Model
{
    protected $fillable = [
        'coins'
    ];

    public function FeesCoins()
    {
        return $this->hasMany(FeesCoins::class);

    }//end of FeesCaches
}
