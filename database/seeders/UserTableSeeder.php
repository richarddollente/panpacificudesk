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
                'password' => bcrypt('password')
            ],
            [
                'id'    => 2,
                'name'  => "Jester Apelado",
                'email' => 'user.apelado@panpacificudesk.com',
                'password' => bcrypt('password')
            ],
            [
                'id'    => 3,
                'name'  => "Rosemarie Ancheta",
                'email' => 'staff.ancheta@panpacificudesk.com',
                'password' => bcrypt('password')
            ],
        ];

        User::insert($user);
    }
}
