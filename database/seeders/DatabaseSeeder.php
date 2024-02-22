<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Uuid;

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

        $this->call([
            CustomerSeeder::class,
            WarehouseSeeder::class,
            ProductSeeder::class,
            OrderSeeder::class,
            LineItemSeeder::class,
            InventorySeeder::class,
        ]);

        $customerProductCollection = DB::table('customers')
            ->join('orders', 'customers.customer_id', '=', 'orders.customer_id')
            ->join('line_items', 'orders.order_id', '=', 'line_items.order_id')
            ->select('customers.customer_id', 'line_items.product_id')
            ->get();

        foreach ($customerProductCollection as $customerProductItem) {
            DB::table('customer_product')->insert([
                'customer_product_id' => Uuid::uuid4()->toString(),
                'customer_id' => $customerProductItem->customer_id,
                'product_id' => $customerProductItem->product_id,
            ]);
        }
    }
}
