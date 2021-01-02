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
        $Administrator = User::factory()->create([
            'name' => 'administrator',
            'email' => 'admin@voltcash.com',
            'password' => bcrypt("1234"),
        ]);
        $Administrator->assignRole($AdministratorRole);

        // Vendedor
        $SellerRole = Role::create(['name' => 'Seller']);
        $Seller = User::factory()->create([
            'name' => 'seller',
            'email' => 'seller@voltcash.com',
            'password' => bcrypt("1234"),
        ]);
        $Seller->assignRole($SellerRole);

        // Cumplimiento
        $ComplianceRole = Role::create(['name' => 'Compliance']);
        $Compliance = User::factory()->create([
            'name' => 'compliance',
            'email' => 'compliance@voltcash.com',
            'password' => bcrypt("1234"),
        ]);
        $Compliance->assignRole($ComplianceRole);

        // Tendero
        $ShopkeeperRole = Role::create(['name' => 'Shopkeeper']);
        $Shopkeeper = User::factory()->create([
            'name' => 'shopkeeper',
            'email' => 'shopkeeper@voltcash.com',
            'password' => bcrypt("1234"),
        ]);
        $Shopkeeper->assignRole($ShopkeeperRole);
    }
}
