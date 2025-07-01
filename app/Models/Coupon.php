<?php

namespace App\Models;
use Carbon\Carbon;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    protected $fillable = ['code', 'type', 'value', 'expires_at'];

    public function isExpired()
    {
    	return $this->expires_at < now();
    }
    public function discountAmount($subtotal)
    {
    	return $this->type === 'percent' 
    			? ($subtotal * $this->value) / 100
    			: $this->value;
    }
}
