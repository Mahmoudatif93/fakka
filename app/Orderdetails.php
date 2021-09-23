<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Orderdetails extends Model
{
    protected $fillable = [
        'orderheaders_id','delivery_type','shipping_address','product_name','category_name','product_weight','product_qty','commission','recet_no','certificate_no','totalpoints','product_id','purchased'
    ];


    public function Orderheader()
    {
        return $this->belongsTo(Orderheader::class,'orderheaders_id','id');

    }//end of Orderheader

    
}
