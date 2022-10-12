<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\PaymentType;

class PaymentTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    const MAX_PAYMENT_TYPES = 3;

    public function run()
    {

        PaymentType::factory(self::MAX_PAYMENT_TYPES)->create();
    }
}
