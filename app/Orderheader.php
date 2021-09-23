<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Orderheader extends Model
{
    protected $fillable = [
        'client_id','order_date','totalpayments','price_per_gram','totalQty','status','virtual',
    ];
    public function client()
    {
        return $this->belongsTo(Client::class);

    }//end of user

    public function Orderdetails()
  {
      return $this->hasMany(Orderdetails::class,'orderheaders_id','id');

  }//end of Orderdetails

}
