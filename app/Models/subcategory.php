<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class subcategory extends Model
{
    protected $fillable=
    [
    	'subcat_name',
    	'categories_id'
    ];

    public function products()
	{
	    return $this->hasMany(Product::class, 'category_id');
	}

	public function category()
	{
	    return $this->belongsTo(Category::class, 'categories_id');
	}
}
