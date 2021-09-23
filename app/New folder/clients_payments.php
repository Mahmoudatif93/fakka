<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class clients_payments extends Model
{
    protected $fillable = [
        'client_id', 'client_name','client_email',  'client_phone', 'delivery_type','shipping_address',
        'iban', 'total_price','product_name',  'category_name', 'price_per_gram','product_id',
        'product_weight', 'product_qty','totalQty','paid_at'
    ];

}
