<?php

namespace Database\Seeders;

use App\Models\Review;
use App\Models\User;
use App\Models\Vendor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VendorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Vendor::factory(4)->make()->each(function (Vendor $vendor) {
            $user = User::factory()->create();
            $vendor->user()->associate($user);
            $vendor->save();



            $vendor->foodItems()->saveMany(
                \App\Models\FoodItem::factory(10)
                    ->create([
                        'vendor_id' => $vendor->id
                    ])
                    ->each(function ($foodItem) {
                        $foodItem->likes()->createMany([
                            ['likeable_id' => $foodItem->id, 'likeable_type' => 'FoodItem', 'user_id' => 1]
                        ]);
                        $review_count = rand(0, 10);
                        $foodItem->reviews()->createMany(
                            Review::factory($review_count)->make()->each(function ($review) {
                                $review->customer()->associate(1);
                            })->toArray()

                        );
                    })
            );
            $vendor->foodItems()->limit(3)->get()->each(function ($foodItem) {
                $foodItem->price = $foodItem->price * 0.8;
                $foodItem->save();
            });

            $vendor->save();
        });
    }
}
