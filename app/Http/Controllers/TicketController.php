<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\Ticket;
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

    public function store(StoreTicketRequest $request)
    {
        Ticket::create($request->validated());
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
