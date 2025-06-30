<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    Protected $fillable=['cat_name'];

    public function subcategories()
	{
	    return $this->hasMany(Subcategory::class, 'categories_id');
	}
	public function products()
    {
        return $this->hasMany(Product::class, 'category_id');
    }

}
