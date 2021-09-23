<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContactsEmail extends Model
{
    protected $fillable = [
        'mobile','email','password',
    ];
}
