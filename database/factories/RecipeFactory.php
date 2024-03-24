<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Recipe>
 */
class RecipeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

     protected const IMAGES = [
        'salad.png',
        'tortilla.png'
     ];


    public function definition(): array
    {

        return [
            'name' =>  fake()->word(),
            'description'  => fake()->paragraph(),
            'image_url' => fake()->randomElement(self::IMAGES),
            'slug'=>fake()->slug()
        ];
    }
}
