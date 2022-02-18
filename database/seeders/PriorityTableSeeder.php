<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Priority;

class PriorityTableSeeder extends Seeder
{

    public function run()
    {
        $priority = [
            [
                'id'    => 1,
                'title' => 'Critical',
            ],
            [
                'id'    => 2,
                'title' => 'High',
            ],
            [
                'id'    => 3,
                'title' => 'Medium',
            ],
            [
                'id'    => 4,
                'title' => 'Low',
            ],
        ];

        Priority::insert($priority);
    }
}
