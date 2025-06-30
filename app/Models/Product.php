<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    Protected $fillable=['name','product_code','price','price_off','category_id','img_path'];

	public function subcategory()
	{
	    return $this->belongsTo(Subcategory::class, 'category_id');
	}
}
