<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable=['user_id','order_number','status','order_number','total_amount','payment_method','shipping_address'];

    public function OrderItem()
    {
    	return $this->hasMany(OrderItem::class,'order_number','order_number');
    }
}
