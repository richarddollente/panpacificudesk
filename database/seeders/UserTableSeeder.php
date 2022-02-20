<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    public function run()
    {
        $user = [
            [
                'id'    => 1,
                'name'  => "Richard Dollente",
                'email' => 'admin.dollente@panpacificudesk.com',
                'password' => bcrypt('password'),
                'class_id' => 1,
            ],
            [
                'id'    => 2,
                'name'  => "Jester Apelado",
                'email' => 'user.apelado@panpacificudesk.com',
                'password' => bcrypt('password'),
                'class_id' => 3,
            ],
            [
                'id'    => 3,
                'name'  => "Rosemarie Ancheta",
                'email' => 'staff.ancheta@panpacificudesk.com',
                'password' => bcrypt('password'),
                'class_id' => 1,
            ],
            [
                'id'    => 4,
                'name'  => "Jhovbert Bogtong",
                'email' => 'admin.bogtong@panpacificudesk.com',
                'password' => bcrypt('password'),
                'class_id' => 1,
            ]
        ];

        User::insert($user);
    }
}
