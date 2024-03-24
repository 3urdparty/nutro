<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Address>
 */
class AddressFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'first_line_address' => $this->faker->streetAddress,
            'second_line_address' => $this->faker->secondaryAddress,
            'state' => $this->faker->state,
            'city' => $this->faker->city,
            'postcode' => $this->faker->postcode,
            'country' => $this->faker->country,
            'is_default' => false,
            'name' => $this->faker->name,
        ];
    }
}
