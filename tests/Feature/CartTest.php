<?php
// tests/Feature/CartTest.php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use App\Models\subcategory;
use App\Models\Cart;

class CartTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_add_product_to_cart()
    {
        $user = User::factory()->create();
        $category = Category::create(['cat_name' => 'Gadgets']);
        $subcat = subcategory::create([
            'subcat_name' => 'Smartphones',
            'categories_id' => $category->id
        ]);

        $product = Product::create([
            'name' => 'iPhone',
            'product_code' => 'IP123',
            'price' => '1000',
            'price_off' => '900',
            'category_id' => $subcat->id,
            'img_path' => 'iphone.jpg'
        ]);

        $cart = Cart::create([
            'user_id' => $user->id,
            'product_id' => $product->id,
            'quantity' => 2
        ]);

        $this->assertDatabaseHas('carts', [
            'user_id' => $user->id,
            'product_id' => $product->id
        ]);
    }
}
