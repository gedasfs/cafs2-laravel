<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\User;
use App\Models\PaymentType;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class UserPaymentTypeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $maxUsers = User::all()->count();
        $maxPaymentTypes = PaymentType::all()->count();

        return [
            'user_id' => fake()->numberBetween(1, $maxUsers),
            'payment_type_id' => fake()->numberBetween(1, $maxPaymentTypes),
        ];
    }
}
