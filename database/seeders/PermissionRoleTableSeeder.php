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
        Permission::findOrFail(3)->roles()->sync(1);
        Permission::findOrFail(1)->roles()->sync(1);
        Permission::findOrFail(5)->roles()->sync(1);
        Permission::findOrFail(1)->roles()->sync(3);
        Permission::findOrFail(4)->roles()->sync(3);
        Permission::findOrFail(2)->roles()->sync(2);
    }
}
