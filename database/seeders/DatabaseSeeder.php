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
            UserTableSeeder::class,
            PermissionsTableSeeder::class,
            PriorityTableSeeder::class,
            CategoryTableSeeder::class,
            StatusTableSeeder::class,
            TicketTableSeeder::class,
            RolesTableSeeder::class,
            PermissionRoleTableSeeder::class,
            RoleUserTableSeeder::class,
            CommentTableSeeder::class,
        ]);
    }
}
