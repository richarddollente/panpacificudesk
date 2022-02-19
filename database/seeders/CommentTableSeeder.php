<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Comment;

class CommentTableSeeder extends Seeder
{
    public function run()
    {
        $comment = [
            [
                'id'    => 1,
                'user_id' => 1,
                'body' => 'This is a test: User 1, Ticket 2',
                'ticket_id' => 2,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ],
            [
                'id'    => 2,
                'user_id' => 2,
                'body' => 'This is a test: User 2, Ticket 2',
                'ticket_id' => 2,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ],
            [
                'id'    => 3,
                'user_id' => 3,
                'body' => 'This is a test: User 3, Ticket 2',
                'ticket_id' => 2,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ],
        ];

        Comment::insert($comment);
    }
}
