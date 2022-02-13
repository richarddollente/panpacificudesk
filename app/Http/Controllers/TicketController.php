<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class TicketController extends Controller
{
    public function index()
    {
        $tickets = Ticket::all();
        return view('tickets.index', compact('tickets'));
    }

    public function create()
    {
        return view('tickets.create');
    }

    public function store(Request $request)
    {
        $ticket = Ticket::create([
            'user_id' => Auth::user()->name,
            'subject' => request('subject'),
            'description' => request('description'),
            'admin_id' => 1,

        ]);
        if($request->hasFile('file') && $request->file('file')->isValid()){
            $ticket->addMediaFormRequest('file')->toMediaCollection('file');
        }

        return redirect()->route(route:'tickets.index');
    }

    public function show(Ticket $ticket)
    {
        return view('tickets.index', compact('ticket'));
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
