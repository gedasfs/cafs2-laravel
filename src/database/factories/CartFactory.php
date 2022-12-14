<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\User;
use App\Models\Product;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Cart>
 */
class CartFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $itemCount = fake()->numberBetween(1, 10);

        $cartContent = [];

        for ($i = 1; $i <= $itemCount; $i++) {
            $cartContent[] = [
                'product_id' => Product::factory()->create()->id,
                'qty' => fake()->numberBetween(1, 10),
            ];
        }

        return [
            'user_id' => User::factory(),
            'cart_content' => json_encode($cartContent),
            'total_for_items' => fake()->randomFloat(2, 50, 9999),
        ];


        // $table->json() column example format:
        /*
        [
            {
                "product_id": "id1",
                "qty": 0
            },
            {
                "product_id": "id5",
                "qty": 2
            }
        ]
        */
    }
}
