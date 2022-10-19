<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\User;
use App\Models\PaymentType;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        // User::factory()
        //     ->count(3)
        //     ->hasUserPaymentType(1, ['payment_type_id' => PaymentType::factory()])
        //     ->create();

        // User::factory()
        //     ->count(3)
        //     ->hasUserPaymentType(1)
        //     ->create();
    }
}
