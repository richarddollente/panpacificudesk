<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Console\Migrations\RollbackCommand;
use Illuminate\Database\Seeder;

class PermissionRoleTableSeeder extends Seeder
{
    public function run()
    {
        Permission::find(1)->roles()->sync(1);
        Permission::find(3)->roles()->sync(1);
        Permission::find(5)->roles()->sync(1);
        Permission::find(2)->roles()->sync(2);
        Permission::find(4)->roles()->sync(3);
    }
}
