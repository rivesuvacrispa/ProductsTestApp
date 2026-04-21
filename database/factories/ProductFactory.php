<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->words(2, true),
            'in_stock' => $this->faker->boolean(75),
            'rating' => $this->faker->randomFloat(2,0, 5),
            'price' => $this->faker->randomFloat(2,10, 100),
            'category_id' => Category::inRandomOrder()->first()->id,
        ];
    }
}
