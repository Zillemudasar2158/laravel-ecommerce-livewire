<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $fillable=['order_number','user_id','product_code','product_name','quantity','product_price','price_off'];

    public function order()
    {
    	return $this->belongsTo(Order::class,'order_number');
    }
    
}
