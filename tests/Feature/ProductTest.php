<?php
// tests/Feature/ProductTest.php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Product;
use App\Models\Category;
use App\Models\subcategory;

class ProductTest extends TestCase
{
    use RefreshDatabase;

    public function test_product_can_be_created_with_valid_subcategory()
    {
        $category = Category::create(['cat_name' => 'Books']);
        $subcat = subcategory::create([
            'subcat_name' => 'Fiction',
            'categories_id' => $category->id
        ]);

        $product = Product::create([
            'name' => 'Harry Potter',
            'product_code' => 'HP123',
            'price' => '500',
            'price_off' => '400',
            'category_id' => $subcat->id,
            'img_path' => 'hp.jpg' 
        ]);

        $this->assertDatabaseHas('products', ['name' => 'Harry Potter']);
    }
}
            