<?php

namespace Database\Factories;

use App\Models\Customer;
use Illuminate\Database\Eloquent\Factories\Factory;
use Ramsey\Uuid\Uuid;

/**
 * @extends Factory<Customer>
 */
class CustomerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = $this->faker->name();
        $type = $this->faker->randomElement(['personal', 'business']);
        if ($type === 'business') {
            $name = $this->faker->company();
        }

        return [
            'customer_id' => Uuid::uuid4()->toString(),
            'name' => $name,
            'type' => $type,
            'email' => $this->faker->email(),
            'address' => $this->faker->address(),
            'city' => $this->faker->city(),
            'state' => $this->faker->state(),
            'postal_code' => $this->faker->postcode(),
            'country' => $this->faker->country(),
        ];
    }
}
