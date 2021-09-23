<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClientGifts extends Model
{
    protected $fillable = [
        'gift_id','client_email','client_name'
    ];

    public function Gifts()
    {
        return $this->belongsTo(Gifts::class,'gift_id','id');

    }//end fo Ingots
}
