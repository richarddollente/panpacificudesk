<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use App\Models\Ticket;
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
            CommentTableSeeder::class,
        ]);
    }
}
