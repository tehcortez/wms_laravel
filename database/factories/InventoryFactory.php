<?php

namespace Database\Factories;

use App\Models\Inventory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Uuid;

/**
 * @extends Factory<Inventory>
 */
class InventoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $product_ids = DB::table('products')->pluck('product_id');
        $warehouse_ids = DB::table('warehouses')->pluck('warehouse_id');

        return [
            'inventory_id' => Uuid::uuid4()->toString(),
            'product_id' => $this->faker->randomElement($product_ids),
            'warehouse_id' => $this->faker->randomElement($warehouse_ids),
            'quantity_available' => $this->faker->numberBetween(11, 100),
            'minimum_stock_level' => $this->faker->numberBetween(1, 10),
            'maximum_stock_level' => $this->faker->numberBetween(100, 200),
        ];
    }
}
