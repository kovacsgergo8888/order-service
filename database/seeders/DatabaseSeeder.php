<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Order;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        for ($i = 0; $i < 1000; $i++) {
            $order = Order::create([
                'name' => 'Johnny Silverhand',
                'email'=> 'arasaki@hater.com',
                'shipping_type' => 'COURIER_SHIPPING',
                'shipping_name' => 'Shipping John',
                'shipping_city' => 'Night City',
                'shipping_postcode' => '1234',
                'shipping_address' => 'Street 1',
                'billing_name' => 'Shipping John',
                'billing_city' => 'Night City',
                'billing_postcode' => '1234',
                'billing_address' => 'Street 1',
            ]);

            $order->orderProducts()->createMany([
                [
                    'name' => 'Gun',
                    'price' => 1000,
                    'quantity' => rand(1, 5)
                ],
                [
                    'name' => 'Medpack',
                    'price' => 100,
                    'quantity' => rand(1, 5)
                ]
            ]);
        }

    }
}
