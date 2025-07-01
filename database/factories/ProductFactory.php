<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->word(),
            'price' => $this->faker->numberBetween(100, 1000),
            'price_off' => null,
            'product_code' => 'P-' . $this->faker->unique()->numberBetween(1000, 9999),
            'img_path' => 'default.jpg',
            'category_id' => 1, // make sure category with id=1 exists in subcategories
        ];
    }
}
