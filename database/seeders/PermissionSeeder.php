<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Administrator
        $AdministratorRole = Role::create(['name' => 'Administrator']);
        $administrator = User::factory()->create([
            'name' => 'administrator',
            'email' => 'admin@admin.com',
            // 'password' => bcrypt("1234"),
            'password' => "1234",
        ]);
        $administrator->assignRole($AdministratorRole);

        // Vendedor
        $SellerRole = Role::create(['name' => 'Seller']);
        $seller = User::factory()->create([
            'name' => 'seller',
            'email' => 'seller@voltcash.com',
            // 'password' => bcrypt("1234"),
            'password' => "1234",
        ]);
        $seller->assignRole($SellerRole);

        // Cumplimiento
        $ComplianceRole = Role::create(['name' => 'Compliance']);
        $compliance = User::factory()->create([
            'name' => 'compliance',
            'email' => 'compliance@voltcash.com',
            // 'password' => bcrypt("1234"),
            'password' => "1234",
        ]);
        $compliance->assignRole($ComplianceRole);

        // Tendero
        $ShopkeeperRole = Role::create(['name' => 'Shopkeeper']);
        $shopkeeper = User::factory()->create([
            'name' => 'shopkeeper',
            'email' => 'shopkeeper@voltcash.com',
            // 'password' => bcrypt("1234"),
            'password' => "1234",
        ]);
        $shopkeeper->assignRole($ShopkeeperRole);


        // PERMISOS 
        Permission::create(['name' => 'list stores']);
        Permission::create(['name' => 'create stores']);
        Permission::create(['name' => 'show stores']);
        Permission::create(['name' => 'update stores']);
        Permission::create(['name' => 'delete stores']);
        Permission::create(['name' => 'show own stores']);
        Permission::create(['name' => 'update own stores']);
        Permission::create(['name' => 'delete own stores']);
        Permission::create(['name' => 'restore own stores']);

        // Asign permissions 

        $seller->givePermissionTo([
            'show own stores', 'update own stores'
        ]);

        $compliance->givePermissionTo([
            'list stores', 'update stores', 'delete stores'
        ]);

        $shopkeeper->givePermissionTo([
            'update own stores'
        ]);
    }
}
