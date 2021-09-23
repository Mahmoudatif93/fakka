<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClientWallet extends Model
{
    protected $fillable = [
        'client_id','client_name', 'client_email', 'client_phone', 'amount','iban',
    ];
}
