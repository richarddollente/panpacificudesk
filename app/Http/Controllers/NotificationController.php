<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;
use Monolog\Logger;
use Symfony\Component\HttpFoundation\Response;

class NotificationController extends Controller
{
    public function index()
    {
        Log::info("User: " . (Auth::user()->email) . " viewed Notification index.");
        $commentnotifications = auth()->user()->unreadNotifications;
        return view('notifications.index', compact('commentnotifications'));
    }

    public function show($id)
    {

        $notification = auth()->user()->notifications()->where('id', $id)->first();
        $ticket_id = str_replace('"', "", json_encode($notification->data['ticket_id']));
        $comment_id = str_replace('"', "", json_encode($notification->data['comment_id']));
        Log::info("User: " . (Auth::user()->email) . " viewed Notification: Ticket: ". $ticket_id ." Comment: ". $comment_id .".");
        if ($notification) {
            $notification->markAsRead();
            return redirect()->route('tickets.show', $ticket_id.'#'.$comment_id);
        }
    }
}
