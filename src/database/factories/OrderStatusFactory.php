<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

include_once dirname(__DIR__) .  '/_names.php';

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\OrderStatus>
 */
class OrderStatusFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => fake()->bothify('order-stat-???-###'),
        ];
    }
}
