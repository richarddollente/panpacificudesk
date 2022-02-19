<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;use Symfony\Component\HttpFoundation\Response;

class TicketController extends Controller
{
    public function index()
    {

        $tickets = Ticket::all();
        if(Gate::allows('ticket_access')){
            $tickets = Ticket::where('user_id', Auth::user()->id)->get();

            return view('tickets.index', compact('tickets'));
        }
        elseif(Gate::allows('staff-ticket_access')){
            $tickets = Ticket::where('admin_id', Auth::user()->id)->get();
            return view('tickets.staff', compact('tickets'));
        }
        return view('tickets.admin', compact('tickets'));

    }

    public function create()
    {
        return view('tickets.create');
    }

    public function store(Request $request)
    {
        $hasFile = $request->hasFile('ticket_file');
        if($hasFile){
            $file = $request->file('ticket_file');
            dump($filePath = Storage::disk('public')->putFile('ticket_files', $file));
            dump(Ticket::create([
                'user_id' => Auth::user()->id,
                'subject' => request('subject'),
                'description' => request('description'),
                'admin_id' => 1,
                'category_id' => 1,
                'ticket_file' => $filePath,
            ]));

        }
        else
        {
            Ticket::create([
                'user_id' => Auth::user()->id,
                'subject' => request('subject'),
                'description' => request('description'),
                'admin_id' => 1,
                'category_id' => 1,
            ]);
        }

        return redirect()->route(route:'tickets.index');
    }

    public function show(Ticket $ticket)
    {
        if(Gate::allows('admin-ticket_access') || Gate::allows('staff-ticket_access') || (Auth::user()->id === $ticket->user_id))
        {
            $username = DB::table('users')->where('id', ($ticket->user_id))->value('name');
            $category = DB::table('categories')->where('id', ($ticket->category_id))->value('title');
            $status = DB::table('statuses')->where('id', ($ticket->status_id))->value('title');
            $priority = DB::table('priorities')->where('id', ($ticket->priority_id))->value('title');
            $admin = DB::table('users')->where('id', ($ticket->admin_id))->value('name');
            return view('tickets.show', compact('ticket', 'username', 'category', 'status', 'priority', 'admin'));
        }
        else
        {
            return view('tickets.403');
        }
    }

    public function edit(Ticket $ticket)
    {
        return view('ticket.edit');
    }

    public function update(UpdateTicketRequestRequest $request, Ticket $ticket)
    {
        $ticket->update($request->validated());
        return redirect()->route(route:'tickets.index');
    }

    public function destroy(Ticket $ticket)
    {
        $ticket->delete();
        return redirect()->route(route:'tickets.index');
    }
}
