<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class RoleUserTableSeeder extends Seeder
{
    public function run()
    {
        User::find(1)->roles()->sync(1);
        User::find(2)->roles()->sync(1);
        User::find(3)->roles()->sync(3);
        User::find(4)->roles()->sync(3);
        User::find(5)->roles()->sync(1);
        User::find(6)->roles()->sync(2);
        User::find(7)->roles()->sync(2);
        User::find(8)->roles()->sync(3);
        User::find(9)->roles()->sync(2);
        User::find(10)->roles()->sync(2);
        User::find(11)->roles()->sync(3);
        User::find(12)->roles()->sync(3);
        User::find(13)->roles()->sync(3);
        User::find(14)->roles()->sync(1);
        User::find(15)->roles()->sync(1);
    }
}
