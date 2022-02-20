<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ticket;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CommentsController extends Controller
{
    public function store(Ticket $ticket)
    {
        $this->validate(request(), ['body' => 'required|min:2']);
        Comment::create([
            'body' =>request('body'),
            'ticket_id' => $ticket->id,
            'user_id' => Auth::user()->id,
        ]);

        DB::table('tickets')->where('id', $ticket->id)->update([
            'updated_at' => date("Y-m-d H:i:s"),
        ]);

        return redirect(url()->previous().'#CommentBody');
    }
}
