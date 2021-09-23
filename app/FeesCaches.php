<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FeesCaches extends Model
{
    protected $fillable = [
        'ingots_id','fees','cache_back',
    ];


    public function Ingots()
    {
        return $this->belongsTo(Ingots::class);

    }//end fo Ingots
}
