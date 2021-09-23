<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserShopingCart extends Model
{
    protected $fillable = [
        'client_id', 'category_id','product_id',  'totalPrice', 'totalQty','qty',
    ];


    public function client()
    {
        return $this->belongsTo(Client::class);

    }
    public function category()
    {
        return $this->belongsTo(Category::class)->with('CategoryTranslation');

    }
    public function product()
    {
        return $this->belongsTo(Product::class);

    }
    public function ProductTranslation()
    {
        return $this->belongsTo(ProductTranslation::class,'product_id','product_id');

    }


}
