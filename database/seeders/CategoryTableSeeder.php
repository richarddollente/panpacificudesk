<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategoryTableSeeder extends Seeder
{

    public function run()
    {
        $category = [
            [
                'id'    => 1,
                'title' => 'Uncategorized',
            ],
            [
                'id'    => 2,
                'title' => 'PU Official Website',
            ],
            [
                'id'    => 3,
                'title' => 'AIMS',
            ],
            [
                'id'    => 4,
                'title' => 'Google Classroom',
            ],
            [
                'id'    => 5,
                'title' => 'PU Email',
            ],
            [
                'id'    => 6,
                'title' => 'Computer Laboratory',
            ],
            [
                'id'    => 7,
                'title' => 'School Wi-Fi',
            ],
            [
                'id'    => 8,
                'title' => 'Others',
            ],
        ];

        Category::insert($category);
    }
}
