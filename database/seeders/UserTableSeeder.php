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
                'email' => 'dollente.richard@panpacificu.edu.ph',
                'password' => bcrypt('password'),
                'class_id' => 1,
            ],
            [
                'id'    => 2,
                'name'  => "Jester Apelado",
                'email' => 'apelado.jestergil@panpacificu.edu.ph',
                'password' => bcrypt('password'),
                'class_id' => 1,
            ],
            [
                'id'    => 3,
                'name'  => "Rosemarie Ancheta",
                'email' => 'ancheta.rosemarie@panpacificu.edu.ph',
                'password' => bcrypt('password'),
                'class_id' => 1,
            ],
            [
                'id'    => 4,
                'name'  => "Troei Jigz Lenox Ramos",
                'email' => 'ramos.troeijigzlenox@panpacificu.edu.ph',
                'password' => bcrypt('password'),
                'class_id' => 1,
            ],
            [
                'id'    => 5,
                'name'  => "Neil Patrick Alvarez",
                'email' => 'alvarez.neil@panpacificu.edu.ph',
                'password' => bcrypt('password'),
                'class_id' => 1,
            ],
            [
                'id'    => 6,
                'name'  => "Jhovbert Bogtong",
                'email' => 'bogtong.jhovhert@panpacificu.edu.ph',
                'password' => bcrypt('password'),
                'class_id' => 3,
            ],
            [
                'id'    => 7,
                'name'  => "Olusola Matthew David",
                'email' => 'david.olusolamatthew@panpacificu.edu.ph',
                'password' => bcrypt('password'),
                'class_id' => 3,
            ],
            [
                'id'    => 8,
                'name'  => "Theresa Tantay Limos",
                'email' => 'limos.theresa@panpacificu.edu.ph',
                'password' => bcrypt('password'),
                'class_id' => 2,
            ],
            [
                'id'    => 9,
                'name'  => "Janice Merca",
                'email' => 'merca.janice@panpacificu.edu.ph',
                'password' => bcrypt('password'),
                'class_id' => 3,
            ],
            [
                'id'    => 10,
                'name'  => "Ronalyn Rance",
                'email' => 'rance.ronalyn@panpacificu.edu.ph',
                'password' => bcrypt('password'),
                'class_id' => 3,
            ],
            [
                'id'    => 11,
                'name'  => "Armie Quizon Valencia",
                'email' => 'valencia.armie@panpacificu.edu.ph',
                'password' => bcrypt('password'),
                'class_id' => 1,
            ],
            [
                'id'    => 12,
                'name'  => "Maricar Ignacio",
                'email' => 'ignacio.maricar@panpacificu.edu.ph',
                'password' => bcrypt('password'),
                'class_id' => 3,
            ],
            [
                'id'    => 13,
                'name'  => "Rico Andrei Mejia",
                'email' => 'mejia.ricoandrei@panpacificu.edu.ph',
                'password' => bcrypt('password'),
                'class_id' => 3,
            ],
            [
                'id'    => 14,
                'name'  => "Jane Fernandez",
                'email' => 'fernandez.jane@panpacificu.edu.ph',
                'password' => bcrypt('password'),
                'class_id' => 1,
            ],
            [
                'id'    => 15,
                'name'  => "Angelina Domingo",
                'email' => 'domingo.angelina@panpacificu.edu.ph',
                'password' => bcrypt('password'),
                'class_id' => 1,
            ]
        ];

        User::insert($user);
    }
}
