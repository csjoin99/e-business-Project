<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_admin = Role::where('name','Admin')->first();
        /* $role_admin = Role::create(['name' => 'Admin']);
        $role_client = Role::create(['name' => 'Cliente']); */

        /* $role_admin->givePermissionTo(Permission::create(['name' => 'admin.category']));
        $role_admin->givePermissionTo(Permission::create(['name' => 'admin.product']));
        $role_admin->givePermissionTo(Permission::create(['name' => 'admin.product.photo']));
        $role_admin->givePermissionTo(Permission::create(['name' => 'admin.coupon']));
        $role_admin->givePermissionTo(Permission::create(['name' => 'admin.user']));
        $role_admin->givePermissionTo(Permission::create(['name' => 'admin.order']));
        $role_admin->givePermissionTo(Permission::create(['name' => 'admin.cash.register']));
        $role_admin->givePermissionTo(Permission::create(['name' => 'admin.dashboard']));
        $role_admin->givePermissionTo(Permission::create(['name' => 'admin.provider']));
        $role_admin->givePermissionTo(Permission::create(['name' => 'admin.buy_order']));
        $role_admin->givePermissionTo(Permission::create(['name' => 'admin.audit'])); */
        $role_admin->givePermissionTo(Permission::create(['name' => 'admin.settings']));
    }
}

