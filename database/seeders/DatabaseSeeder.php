<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Cart;
use App\Models\Customer;
use App\Models\DeliveryPerson;
use App\Models\User;
use App\Models\Vendor;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\Recipe::factory(10)->create();

        User::factory()->create([
            'first_name' => 'Mustafa',
            'last_name' => 'Yousif',
            'email' => 'mustafa.y.elagib@gmail.com',
            'password' => bcrypt('password'),
        ])->each(fn ($user) => $user
            ->customer()
            ->save(
                Customer::factory()->make()
            ));

        User::find(1)
            ->deliveryPerson()
            ->save(
                DeliveryPerson::factory()->make()
            );

        User::find(1)
            ->vendor()
            ->save(
                Vendor::factory()->make()
            );

        User::find(1)->vendor->foodItems()->saveMany(\App\Models\FoodItem::factory(10)->make());
        User::find(1)->customer->addresses()->saveMany(\App\Models\Address::factory(1)->make(['is_default' => true]));
        User::find(1)->customer->addresses()->saveMany(\App\Models\Address::factory(2)->make());



        $this->call([
            CustomerSeeder::class,
            VendorSeeder::class,
            OrderSeeder::class,
        ]);
    }
}
