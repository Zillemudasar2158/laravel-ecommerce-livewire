<?php
namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class subcategoryFactory extends Factory
{
    protected $model = \App\Models\subcategory::class;

    public function definition(): array
    {
        return [
            'subcat_name' => $this->faker->word(),
            'slug' => $this->faker->slug(),
        ];
    }
}
