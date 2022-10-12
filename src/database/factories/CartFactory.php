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

        $maxUsers = User::all()->count();
        $cartContent = [
            [
                'product_id' => Product::inRandomOrder()->first()->id,
                'qty' => 2,
            ],
            [
                'product_id' => Product::inRandomOrder()->first()->id,
                'qty' => 1,
            ]
        ];

        return [
            'user_id' => fake()->numberBetween(1, $maxUsers),
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
