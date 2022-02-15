<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            [
                'id'    => 1,
                'title' => 'user_access',
            ],
            [
                'id'    => 2,
                'title' => 'ticket_access',
            ],
            [
                'id'    => 3,
                'title' => 'admin-ticket_access',
            ],
            [
                'id'    => 4,
                'title' => 'staff-ticket_access',
            ],
            [
                'id'    => 5,
                'title' => 'dashboard_access',
            ],
        ];

        Permission::insert($permissions);
    }
}
