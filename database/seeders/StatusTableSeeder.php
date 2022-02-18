<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Status;

class StatusTableSeeder extends Seeder
{
    public function run()
    {
        $status = [
            [
                'id'    => 1,
                'title' => 'Open',
            ],
            [
                'id'    => 2,
                'title' => 'In Progress',
            ],
            [
                'id'    => 3,
                'title' => 'Closed',
            ],
        ];

        Status::insert($status);
    }
}
