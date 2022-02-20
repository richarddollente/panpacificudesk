<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Classes;

class ClassesTableSeeder extends Seeder
{

    public function run()
    {
        $classes = [
            [
                'id'    => 1,
                'title' => 'IT Office',
            ],
            [
                'id'    => 2,
                'title' => 'Administration Office',
            ],
            [
                'id'    => 3,
                'title' => 'General User',
            ],
        ];

        Classes::insert($classes);
    }
}
