<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Category;
use Illuminate\Database\Seeder;

use App\Models\PaymentType;
use App\Models\UserPaymentType;
use Illuminate\Support\Facades\Facade;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UserSeeder::class,
            PaymentTypeSeeder::class,
            UserPaymentTypeSeeder::class,
            CategorySeeder::class,
            ProductSeeder::class,
            CartSeeder::class,
            OrderSeeder::class,
            DeliverySeeder::class,
            PaymentSeeder::class,
            DeliveryStatusSeeder::class,
            OrderStatusSeeder::class,
            PaymentStatusSeeder::class,
        ]);
    }

}
