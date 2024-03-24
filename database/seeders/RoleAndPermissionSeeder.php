<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Permission::create(['name' => 'create-cart-items']);
        Permission::create(['name' => 'create-order']);


        $customerRole = Role::create(['name' => 'Customer']);
        $vendorRole = Role::create(['name' => 'Vendor']);
        $adminRole = Role::create(['name' => 'Admin']);
        $deliveryPersonRole = Role::create(['name' => 'DeliveryPerson']);

        $customerRole->givePermissionTo([
            'create-cart-items',
            'create-order',
        ]);
    }
}
