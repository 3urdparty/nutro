<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\Order;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Customer::all()->each(function (Customer $customer) {
        //     $customer->orders()->saveMany(Order::factory(2)->make());
        //     $customer->orders()->each(function (Order $order) {
        //         $food_items = \App\Models\FoodItem::all()->random(10);
        //         $order->items()->attach($food_items->pluck('id')->toArray(), ['quantity' => 1]);
        //         $order->delivery()->save(\App\Models\Delivery::factory()->make(
        //             [
        //                 'from_first_line_address' => '1st line address',
        //                 'from_second_line_address' => '2nd line address',
        //                 'from_state' => 'state',
        //                 'from_city' => 'city',
        //                 'from_postcode' => 'postcode',
        //                 'from_country' => 'country',
        //                 'to_first_line_address' => '1st line address',
        //                 'to_second_line_address' => '2nd line address',
        //                 'to_state' => 'state',
        //                 'to_city' => 'city',
        //                 'to_postcode' => 'postcode',
        //                 'to_country' => 'country',
        //                 'status' => 'pending',
        //             ]
        //         ));
        //     });
        // });
    }
}
