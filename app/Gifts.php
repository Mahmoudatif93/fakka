<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gifts extends Model
{
    protected $fillable = [
        'gift_points','gift_name', 'gift_image', 
    ];

    public function ClientGifts()
    {
        return $this->hasMany(ClientGifts::class);

    }//end of FeesCaches
}
