<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ingots extends Model
{
    protected $fillable = [
        'ingots'
    ];

    public function FeesCaches()
    {
        return $this->hasMany(FeesCaches::class);

    }//end of FeesCaches
    
}
