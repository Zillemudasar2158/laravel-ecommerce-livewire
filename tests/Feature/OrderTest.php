<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Category;
use App\Models\subcategory;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;

class OrderTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_create_order_with_items()
    {
        // Step 1: Create dummy user
        $user = User::factory()->create();

        // Step 2: Create category and subcategory
        $category = Category::create(['cat_name' => 'Electronics']);
        $subcat = subcategory::create([
            'subcat_name' => 'Laptops',
            'categories_id' => $category->id
        ]);

        // Step 3: Create product
        $product = Product::create([
            'name' => 'MacBook Pro',
            'product_code' => 'MBP2025',
            'price' => 2000,
            'price_off' => 1800,
            'category_id' => $subcat->id,
            'img_path' => 'macbook.jpg'
        ]);

        // Step 4: Create Order
        $order = Order::create([
            'user_id' => $user->id,
            'order_number' => 'ORD' . now()->timestamp,
            'status' => 'pending',
            'total_amount' => 3600,
            'payment_method' => 'COD',
            'shipping_address' => 'Test Street',
            'coupon_code' => null,
            'discount' => 0
        ]);

        // Step 5: Add OrderItem
        $order->OrderItem()->create([
            'order_number' => $order->order_number,
            'user_id' => $user->id,
            'product_code' => $product->product_code,
            'product_name' => $product->name,
            'quantity' => 2,
            'product_price' => $product->price,
            'price_off' => $product->price_off,
        ]);

        // Step 6: Assert DB has order
        $this->assertDatabaseHas('orders', [
            'user_id' => $user->id,
            'order_number' => $order->order_number
        ]);

        $this->assertDatabaseHas('order_items', [
            'order_number' => $order->order_number,
            'product_code' => 'MBP2025',
            'quantity' => 2
        ]);
    }
}
