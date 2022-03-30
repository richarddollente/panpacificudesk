<?php

namespace App\Http\Controllers;

use App\Notifications\CommentTicketNotification;
use App\Models\User;
use App\Models\Ticket;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CommentsController extends Controller
{
    public function store(Ticket $ticket)
    {
        $admin = DB::table('tickets')->where('id', $ticket->id)->value('admin_id');
        $user = DB::table('tickets')->where('id', $ticket->id)->value('user_id');
        $this->validate(request(), ['body' => 'required|min:2']);
        $comment = Comment::create([
            'body' =>request('body'),
            'ticket_id' => $ticket->id,
            'user_id' => Auth::user()->id,
        ]);


        Log::info("User: " . (Auth::user()->email) . " commented on: Ticket: ". $ticket->id ." Comment: ". $comment->body .".");

        DB::table('tickets')->where('id', $ticket->id)->update([
            'updated_at' => date("Y-m-d H:i:s"),
        ]);

        if((Auth::user()->id) === (DB::table('tickets')->where('id', $ticket->id)->value('user_id')))
        {
            User::find($admin)->notify(new CommentTicketNotification($comment));
        }
        elseif ((Auth::user()->id) === (DB::table('tickets')->where('id', $ticket->id)->value('admin_id')))
        {
            User::find($user)->notify(new CommentTicketNotification($comment));
        }
        else
        {
            User::find($user)->notify(new CommentTicketNotification($comment));
            User::find($admin)->notify(new CommentTicketNotification($comment));
        }
        $comment_id = $comment->id;

        return redirect(url()->previous().'#'.$comment_id);
    }
}
