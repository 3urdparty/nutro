<?php

namespace Database\Factories;

use App\Models\FoodItem;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Customer>
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
        return [
            'first_line_address' => fake()->streetAddress,
            'second_line_address' => fake()->secondaryAddress,
            'city' => fake()->city,
            'postcode' => fake()->postcode,
            'state' => fake()->state,
            'country' => fake()->country,
            'dietary_restrictions' => fake()->randomElement(FoodItem::DIETARY_RESTRICTIONS),
            'track_location' => fake()->boolean,

        ];
    }
}
