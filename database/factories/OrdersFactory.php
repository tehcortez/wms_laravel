<?php

namespace Database\Factories;

use App\Models\Customer;
use Ramsey\Uuid\Uuid;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Orders>
 */
class OrdersFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $customer_ids = DB::table('customers')->pluck('customer_id');
        return [
            'order_id' => Uuid::uuid4()->toString(),
            'customer_id' => $this->faker->randomElement($customer_ids),
            'total_price' => $this->faker->numberBetween(99, 999999),
            'ready_to_ship' => $this->faker->boolean(),
        ];
    }
}
