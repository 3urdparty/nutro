<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\FoodItem>
 */
class FoodItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     * 
     */

    const SAMPLE_IMAGES = [
        ['image_url' => '/images/food_items/banana.jpg',],
        ['image_url' => '/images/food_items/broccoli.jpg', 'secondary_image_url' => '/images/food_items/broccoli_2.jpg'],
        ['image_url' => '/images/food_items/cherry_tomatoes.jpg',],
        ['image_url' => '/images/food_items/cilantro.jpg',],
        ['image_url' => '/images/food_items/corn.jpg',],
        ['image_url' => '/images/food_items/eggplant.jpg',],
        ['image_url' => '/images/food_items/eggs.jpg',],
        ['image_url' => '/images/food_items/kiwi.jpg',],
        ['image_url' => '/images/food_items/lemon.jpg',],
        ['image_url' => '/images/food_items/onion.jpg',],
        ['image_url' => '/images/food_items/pear.jpg',],
        ['image_url' => '/images/food_items/peas.jpg',],
        ['image_url' => '/images/food_items/potato_fries.jpg',],
        ['image_url' => '/images/food_items/rasberry.jpg', 'secondary_image_url' => '/images/food_items/rasberry_2.jpg'],
        ['image_url' => '/images/food_items/tomatoes.jpg',],
        ['image_url' => '/images/food_items/walnut.jpg', 'secondary_image_url' => '/images/food_items/walnut_2.jpg'],
        ['image_url' => '/images/food_items/watermelon.jpg'],
    ];
    const SAMPLE_FOODS = [
        [
            'name' => 'Banana',
            'servings' => 1,
            'quantity' => 1,
            'unit' => 'piece',
            'long_description' => 'A banana is an elongated, edible fruit – botanically a berry – produced by several kinds of large herbaceous flowering plants in the genus Musa.',
            'short_description' => 'A banana is an elongated, edible fruit – botanically a berry – produced by several kinds of large herbaceous flowering plants in the genus Musa.',
            'image_url' => '/images/food_items/banana.jpg',
        ],
        [
            'name' => 'Broccoli',
            'servings' => 1,
            'quantity' => 1,
            'unit' => 'piece',
            'long_description' => 'Broccoli is an edible green plant in the cabbage family whose large flowering head, stalk and small associated leaves are eaten as a vegetable.',
            'short_description' => 'Broccoli is an edible green plant in the cabbage family whose large flowering head, stalk and small associated leaves are eaten as a vegetable.',
            'image_url' => '/images/food_items/broccoli.jpg', 'secondary_image_url' => '/images/food_items/broccoli_2.jpg'
        ],
        [
            'name' => 'Cherry Tomatoes',
            'servings' => 1,
            'quantity' => 1,
            'unit' => 'piece',
            'long_description' => 'A cherry tomato is a rounded, small fruited tomato.',
            'short_description' => 'A cherry tomato is a rounded, small fruited tomato thought to be an intermediate genetic admixture between wild currant-type tomatoes and domesticated garden tomatoes.',
            'image_url' => '/images/food_items/cherry_tomatoes.jpg',
        ],
        [
            'name' => 'Cilantro',
            'servings' => 1,
            'quantity' => 1,
            'unit' => 'piece',
            'long_description' => 'Coriander is an annual herb in the family Apiaceae.',
            'short_description' => 'Coriander is an annual herb in the family Apiaceae. It is also known as Chinese parsley, dhania or cilantro.',
            'image_url' => '/images/food_items/cilantro.jpg',
        ],
        [
            'name' => 'Corn',
            'servings' => 1,
            'quantity' => 1,
            'unit' => 'piece',
            'long_description' => 'Maize, also known as corn',
            'short_description' => 'Maize, also known as corn, is a cereal grain first domesticated by indigenous peoples in southern Mexico about 10,000 years ago.',
            'image_url' => '/images/food_items/corn.jpg',
        ],
        [
            'name' => 'Eggplant',
            'servings' => 1,
            'quantity' => 1,
            'unit' => 'piece',
            'long_description' => 'Eggplant, aubergine or brinjal is a plant species in the nightshade family Solanaceae. Solanum melongena is grown worldwide for its edible fruit.',
            'short_description' => 'Eggplant, aubergine or brinjal is a plant species in the nightshade family Solanaceae. Solanum melongena is grown worldwide for its edible fruit.',
            'image_url' => '/images/food_items/eggplant.jpg',
        ],
        [
            'name' => 'Eggs',
            'servings' => 1,
            'quantity' => 1,
            'unit' => 'piece',
            'short_description' => "Eggs are good for your health, high in protein, and can be cooked in many different ways.",
            'long_description' => "Eggs are good for your health, high in protein, and can be cooked in many different ways.",
            'image_url' => '/images/food_items/eggs.jpg',
        ],
        [
            'name' => 'Kiwi',
            'servings' => 1,
            'quantity' => 1,
            'unit' => 'piece',
            'short_description' => "Kiwifruit or Chinese gooseberry is the edible berry of several species of woody vines in the genus Actinidia.",
            'long_description' => "Kiwifruit or Chinese gooseberry is the edible berry of several species of woody vines in the genus Actinidia. The most common cultivar group of kiwifruit is oval, about the size of a large hen's egg.",
            'image_url' => '/images/food_items/kiwi.jpg',
        ],
        [
            'name' => 'Lemon',
            'servings' => 1,
            'quantity' => 1,
            'unit' => 'piece',
            'long_description' => 'A lemon is a yellow citrus fruit that is sour in taste and is often used in culinary applications and for its juice.',
            'short_description' => 'A lemon is a yellow citrus fruit that is sour in taste and is often used in culinary applications and for its juice.',
            'image_url' => '/images/food_items/lemon.jpg',
        ],
        [
            'name' => 'Onion',
            'servings' => 1,
            'quantity' => 1,
            'unit' => 'piece',
            'long_description' => 'An onion is a vegetable that is widely used in cooking for its strong flavor and aroma.',
            'short_description' => 'An onion is a vegetable that is widely used in cooking for its strong flavor and aroma.',
            'image_url' => '/images/food_items/onion.jpg',
        ],
        [
            'name' => 'Pear',
            'servings' => 1,
            'quantity' => 1,
            'unit' => 'piece',
            'long_description' => 'A pear is a sweet and juicy fruit that is typically green or yellow in color.',
            'short_description' => 'A pear is a sweet and juicy fruit that is typically green or yellow in color.',
            'image_url' => '/images/food_items/pear.jpg',
        ],
        [
            'name' => 'Peas',
            'servings' => 1,
            'quantity' => 1,
            'unit' => 'piece',
            'long_description' => 'Peas are small, round green vegetables that are commonly used in cooking and are rich in nutrients.',
            'short_description' => 'Peas are small, round green vegetables that are commonly used in cooking and are rich in nutrients.',
            'image_url' => '/images/food_items/peas.jpg',
        ],
        [
            'name' => 'Potato Fries',
            'servings' => 1,
            'quantity' => 1,
            'unit' => 'piece',
            'long_description' => 'Potato fries are a popular snack made from sliced and deep-fried potatoes.',
            'short_description' => 'Potato fries are a popular snack made from sliced and deep-fried potatoes.',
            'image_url' => '/images/food_items/potato_fries.jpg',
        ],
        [
            'name' => 'Raspberry',
            'servings' => 1,
            'quantity' => 1,
            'unit' => 'piece',
            'long_description' => 'A raspberry is a small, red fruit that is sweet and tart in taste.',
            'short_description' => 'A raspberry is a small, red fruit that is sweet and tart in taste.',
            'image_url' => '/images/food_items/rasberry.jpg',
            'secondary_image_url' => '/images/food_items/rasberry_2.jpg',
        ],
        [
            'name' => 'Tomatoes',
            'servings' => 1,
            'quantity' => 1,
            'unit' => 'piece',
            'long_description' => 'Tomatoes are a juicy and flavorful fruit that is commonly used in cooking and salads.',
            'short_description' => 'Tomatoes are a juicy and flavorful fruit that is commonly used in cooking and salads.',
            'image_url' => '/images/food_items/tomatoes.jpg',
        ],
        [
            'name' => 'Walnut',
            'servings' => 1,
            'quantity' => 1,
            'unit' => 'piece',
            'long_description' => 'A walnut is a nut that is enclosed in a hard shell and is commonly used in baking and cooking.',
            'short_description' => 'A walnut is a nut that is enclosed in a hard shell and is commonly used in baking and cooking.',
            'image_url' => '/images/food_items/walnut.jpg',
            'secondary_image_url' => '/images/food_items/walnut_2.jpg',
        ],
        [
            'name' => 'Watermelon',
            'servings' => 1,
            'quantity' => 1,
            'unit' => 'piece',
            'long_description' => 'Watermelon is a large, juicy fruit that is typically eaten fresh as a refreshing snack.',
            'short_description' => 'Watermelon is a large, juicy fruit that is typically eaten fresh as a refreshing snack.',
            'image_url' => '/images/food_items/watermelon.jpg',
        ],
    ];


    public function definition(): array
    {




        return array_merge(
            [
                'name' => fake()->word(),
                'servings' => fake()->randomDigit(),
                'quantity' => fake()->randomDigit(),
                'unit' => fake()->randomElement(\App\Models\FoodItem::UNITS),
                'protein' => fake()->randomFloat(2, 0, 1000),
                'carbohydrates' => fake()->randomFloat(2, 0, 10),
                'calcium' => fake()->randomFloat(2, 0, 10),
                'calories' => fake()->randomFloat(2, 0, 10),
                'dietary_restriction' => fake()->randomElement(\App\Models\FoodItem::DIETARY_RESTRICTIONS),
                'short_description' => fake()->sentence(),
                'long_description' => fake()->paragraph(),
                'category' => fake()->randomElement(\App\Models\FoodItem::CATEGORIES),
                'price' => fake()->randomFloat(2, 0, 1000),
                'units' => fake()->randomDigit(),
            ],
            fake()->randomElement(self::SAMPLE_FOODS)
        );
    }
}
