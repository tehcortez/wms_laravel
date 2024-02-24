<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Ramsey\Uuid\Uuid;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //
            'product_id' => Uuid::uuid4()->toString(),
            'name' => $this->faker->word(),
            'description' => $this->faker->text(),
            'weight' => $this->faker->numberBetween(1, 10000),   //stored in grams
            'height' => $this->faker->numberBetween(1, 10000),   //stored in milimiters
            'width' => $this->faker->numberBetween(1, 10000),    //stored in milimiters
            'depth' => $this->faker->numberBetween(1, 10000),    //stored in milimiters
        ];
    }
}
