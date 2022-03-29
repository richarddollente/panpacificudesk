<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            ClassesTableSeeder::class,
            RolesTableSeeder::class,
            UserTableSeeder::class,
            PermissionsTableSeeder::class,
            PriorityTableSeeder::class,
            CategoryTableSeeder::class,
            StatusTableSeeder::class,
            TicketTableSeeder::class,
            PermissionRoleTableSeeder::class,
            RoleUserTableSeeder::class,
        ]);
    }
}
