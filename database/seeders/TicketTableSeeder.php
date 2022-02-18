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
                'category_id' => 1,
                'status_id' => 1,
                'priority_id' => 3,
                'ticket_file' => 'ticket_files/1_testing.txt',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ],
            [
                'id'    => 2,
                'user_id'  => 2,
                'subject' => 'Ticket 2, User ID 2, Admin ID 3',
                'description' => 'Ticket 2, User ID 2, Admin ID 3',
                'admin_id' => 3,
                'category_id' => 1,
                'status_id' => 1,
                'priority_id' => 3,
                'ticket_file' => 'ticket_files/2_testing.csv',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ],
            [
                'id'    => 3,
                'user_id'  => 2,
                'subject' => 'Ticket 3, User ID 2, Admin ID 1',
                'description' => 'Ticket 3, User ID 2, Admin ID 1',
                'admin_id' => 3,
                'category_id' => 1,
                'status_id' => 1,
                'priority_id' => 3,
                'ticket_file' => 'ticket_files/3_testing.png',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ],
        ];

        Ticket::insert($ticket);
    }
}
