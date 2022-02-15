<?php

namespace Database\Seeders;

use App\Models\Ticket;
use Illuminate\Database\Seeder;

class TicketTableSeeder extends Seeder
{
    public function run()
    {
        $ticket = [
            [
                'id'    => 1,
                'user_id'  => 1,
                'subject' => 'Ticket 1, User ID 2, Admin ID 3',
                'description' => 'Ticket 1, User ID 2, Admin ID 3',
                'admin_id' => 3,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ],
            [
                'id'    => 2,
                'user_id'  => 2,
                'subject' => 'Ticket 2, User ID 2, Admin ID 3',
                'description' => 'Ticket 2, User ID 2, Admin ID 3',
                'admin_id' => 3,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ],
            [
                'id'    => 3,
                'user_id'  => 2,
                'subject' => 'Ticket 3, User ID 2, Admin ID 1',
                'description' => 'Ticket 3, User ID 2, Admin ID 1',
                'admin_id' => 1,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ],
        ];

        Ticket::insert($ticket);
    }
}
