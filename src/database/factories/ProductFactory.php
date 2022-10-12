<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\Category;
use App\Models\Product;

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
    public function definition()
    {
        $maxCategories = Category::all()->count();

        return [
            'category_id' => fake()->numberBetween(1, $maxCategories),
            'code' => fake()->bothify('???-####'),
            'name' => fake()-> words(3, true),
            'description' => fake()->paragraph(),
            'image' => sprintf('/images/products/%s.jpg', fake()->lexify('img-????')),
            'price' => fake()->randomFloat(2, 0, 999999.99),
            'stock' => fake()->randomDigit(),
            'active' => fake()->numberBetween(0, 1),
        ];
    }
}