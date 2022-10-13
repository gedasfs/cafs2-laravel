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
        $cartContent = [
            [
                'product_id' => Product::factory(),
                'qty' => fake()->numberBetween(1, 10),
            ],
            [
                'product_id' => Product::factory(),
                'qty' => fake()->numberBetween(1, 10),
            ]
        ];

        return [
            'user_id' => User::factory(),
            'cart_content' => json_encode($cartContent),
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
