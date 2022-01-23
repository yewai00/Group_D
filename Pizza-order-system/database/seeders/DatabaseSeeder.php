<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\OrderPizza;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        Order::factory()->count(5)->create();
        OrderPizza::factory()->count(10)->create();
    }
}
