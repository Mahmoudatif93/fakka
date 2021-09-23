<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VirtualDetails extends Model
{
    protected $fillable = [
        'client_id', 'quantity', 'price', 'Phone','email','client_name','total_quantity','recet_no','certificate_no'
    ];
}
