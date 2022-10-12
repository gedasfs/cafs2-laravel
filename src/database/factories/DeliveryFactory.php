<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\Order;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Delivery>
 */
class DeliveryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {

        $firstRandOrder = Order::inRandomOrder()->first();

        return [
            'user_id' => $firstRandOrder->user->id,
            'order_id' => $firstRandOrder->id,
        ];
    }
}
