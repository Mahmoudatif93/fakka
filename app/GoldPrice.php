<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GoldPrice extends Model
{
    protected $fillable = [
        'price_us','price_eg'
    ];
}
