<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\Cart;
use App\Models\User;
use App\Models\UserPaymentType;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $firstRandCart = Cart::inRandomOrder()->first();
        // $randUserPaymentType = UserPaymentType::where('user_id', $firstRandCart->user->id)->get();
        $maxUsers = User::all()->count();

        return [
            'cart_id' => $firstRandCart->id,
            'user_id' => $firstRandCart->user->id,
            'user_payment_type_id' => fake()->numberBetween(1, $maxUsers),
            'number' => fake()->numerify('order-####'),
            'shipping_type' => fake()->randomElement(['shop', 'DPD']),
            'shipping_cost' => fake()->randomFloat(2, 5, 50),
            'total_for_items' => fake()->randomFloat(2, 50, 9999),
            'total' => fake()->randomFloat(2, 50, 9999)
        ];
    }
}
