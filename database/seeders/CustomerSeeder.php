<?php

namespace Database\Seeders;

use App\Models\Customer;

use App\Models\Order;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory(10)->create()->each(fn (User $user) => $user->customer()->save(Customer::factory()->make()));
        Customer::all()->each(fn (Customer $customer) => $customer->addresses()->saveMany(\App\Models\Address::factory(2)->make()));
        // Customer::all()->each(fn (Customer $customer) => $customer->user()->notifications()->saveMany(Notification::factory(10)->make()));
    }
}
