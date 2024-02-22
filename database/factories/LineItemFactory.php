<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Uuid;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\LineItem>
 */
class LineItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $order_ids = DB::table('orders')->pluck('order_id');
        $product_ids = DB::table('products')->pluck('product_id');
        return [
            'line_item_id' => Uuid::uuid4()->toString(),
            'order_id' => $this->faker->randomElement($order_ids),
            'product_id' => $this->faker->randomElement($product_ids),
            'quantity' => $this->faker->numberBetween(1, 10),
            'price' => $this->faker->numberBetween(100, 100000),
        ];
    }
}
