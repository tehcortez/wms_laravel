<?php

namespace Database\Seeders;

use App\Models\Orders;
use Illuminate\Database\Seeder;

class OrdersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Orders::factory()
        ->count(40)
        ->create();
    }
}
