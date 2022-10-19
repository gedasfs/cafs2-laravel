<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\PaymentType;
use App\Models\UserPaymentType;

class UserPaymentTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        UserPaymentType::factory(10)->create();

        // PaymentType::factory(3)
        //     ->has(UserPaymentType::factory()->count(1), 'userPaymentTypes')
        //     ->create();

        // $maxTypes = 3;
        // $paymentTypes = PaymentType::factory($maxTypes)->create();

        // $randPaymentType = fake()->numberBetween(1, $maxTypes);

        // UserPaymentType::factory()
        //     ->count(3)
        //     ->for($paymentTypes[$randPaymentType - 1])
        //     ->create();
    }
}
