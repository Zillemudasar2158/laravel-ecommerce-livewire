<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Category;
use App\Models\subcategory;

class CategoryTest extends TestCase
{
    use RefreshDatabase;

    public function test_category_can_be_created()
    {
        $category = Category::create(['cat_name' => 'Electronics']);

        $this->assertDatabaseHas('categories', [
            'cat_name' => 'Electronics'
        ]);
    }

    public function test_category_can_have_subcategories()
    {
        $category = Category::create(['cat_name' => 'Fashion']);
        $subcategory = subcategory::create([
            'subcat_name' => 'Shirts',
            'categories_id' => $category->id
        ]);

        $this->assertTrue($category->subcategories->contains($subcategory));
    }
}
