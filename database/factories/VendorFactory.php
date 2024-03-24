<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Vendor>
 */

class VendorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    public function definition(): array
    {
        $opening =  fake()->numberBetween(0, 23);
        $closing =  fake()->numberBetween($opening, 23);
        $name = fake()->company();
        $slug = Str::slug($name);
        return [
            'name' => $name,
            'slug' => $slug,
            'logo_url' => fake()->imageUrl(),
            'cover_image_url' => fake()->imageUrl(),
            'description' => fake()->paragraph(),
            'open_time' => $opening,
            'close_time' => $closing,
            'phone_number' => fake()->phoneNumber(),
            'website_url' => fake()->url(),
            'instagram_handle' => fake()->userName(),
            'facebook_url' => fake()->url(),
            'twitter_handle' => fake()->userName(),
            'email' => fake()->email(),
        ];
    }
}
