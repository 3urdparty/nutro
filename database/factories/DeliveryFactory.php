<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Delivery>
 */
class DeliveryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    public function definition(): array
    {
        return [
            'from_first_line_address' => fake()->streetAddress(),
            'from_second_line_address' => fake()->secondaryAddress(),
            'from_state' => fake()->state(),
            'from_city' => fake()->city(),
            'from_postcode' => fake()->postcode(),
            'from_country' => fake()->country(),
            'from_latitude' => fake()->latitude(2.967967, 2.970359),
            'from_longitude' => fake()->longitude(101.621342, 101.622950),

            'to_first_line_address' => fake()->streetAddress(),
            'to_second_line_address' => fake()->secondaryAddress(),
            'to_state' => fake()->state(),
            'to_city' => fake()->city(),
            'to_postcode' => fake()->postcode(),
            'to_country' => fake()->country(),
            'to_latitude' =>  fake()->latitude(2.967967, 2.970359),
            'to_longitude' => fake()->longitude(101.621342, 101.622950),

            'status' => fake()->randomElement(['pending', 'accepted', 'rejected', 'delivered']),
            'delivered_at' => null,
        ];
    }
}
