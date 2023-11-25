<?php
namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\RidesTableSeeder;
use Database\Seeders\RolesTableSeeder;
use Database\Seeders\PermissionRoleTableSeeder;
use Database\Seeders\UsersTableSeeder;
use Database\Seeders\PermissionsTableSeeder;
use Database\Seeders\BusesTableSeeder;
use Database\Seeders\RoleUserTableSeeder;
class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            PermissionsTableSeeder::class,
            RolesTableSeeder::class,
            PermissionRoleTableSeeder::class,
            UsersTableSeeder::class,
            RoleUserTableSeeder::class,
            BusesTableSeeder::class,
            RidesTableSeeder::class,
            ClientTableSeeder::class,
        ]);
    }
}
