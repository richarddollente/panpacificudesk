<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\Category;
use App\Models\Priority;
use App\Models\Status;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Database\Eloquent\Collection;

class TicketController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('query');
        if ($query===NULL){
            $tickets = Ticket::all();

            if($request->has('view_deleted'))
            {
                Log::info("User: " . (Auth::user()->email) . " viewed Ticket Archive index.");
                $tickets = Ticket::onlyTrashed()->get();
            }
            if(Gate::allows('ticket_access')){
                $tickets = Ticket::where('user_id', Auth::user()->id)->get();
                Log::info("User: " . (Auth::user()->email) . " viewed Ticket User index.");
                return view('tickets.index', compact('tickets'));
            }
            elseif(Gate::allows('staff-ticket_access')){
                $tickets = Ticket::where('admin_id', Auth::user()->id)->get();
                Log::info("User: " . (Auth::user()->email) . " viewed Ticket Staff index.");
                return view('tickets.staff', compact('tickets'));
            }
            Log::info("User: " . (Auth::user()->email) . " viewed Ticket Admin index.");
            return view('tickets.admin', compact('tickets'));

        }
        else{
            $tickets = Ticket::where('id', 'LIKE','%' . $query . '%' )->orWhere('subject', 'LIKE','%' . $query . '%' )->get();
            if(Gate::allows('ticket_access')){
                if(ctype_digit($query)){
                    $tickets = Ticket::where('user_id', Auth::user()->id)->where('id', 'LIKE','%' . $query . '%' )->get();
                    Log::info("User: " . (Auth::user()->email) . " searched for " . $query . " on Ticket User index.");
                    return view('tickets.index', compact('tickets'));
                }
                else{
                    $tickets = Ticket::where('user_id', Auth::user()->id)->where('subject', 'LIKE','%' . $query . '%' )->get();
                    Log::info("User: " . (Auth::user()->email) . " searched for " . $query . " on Ticket User index.");
                    return view('tickets.index', compact('tickets'));
                }
            }
            elseif(Gate::allows('staff-ticket_access')){
                $tickets = Ticket::where('admin_id', Auth::user()->id)->andWhere('id', 'LIKE','%' . $query . '%' )->orWhere('subject', 'LIKE','%' . $query . '%' )->get();
                Log::info("User: " . (Auth::user()->email) . " searched for " . $query . " on Ticket Staff index.");
                return view('tickets.staff', compact('tickets'));
            }
            Log::info("User: " . (Auth::user()->email) . " searched for " . $query . " on Ticket Admin index.");
            return view('tickets.admin', compact('tickets'));
        }

    }

    public function create()
    {
        Log::info("User: " . (Auth::user()->email) . " redirected to Ticket Create.");
        return view('tickets.create');
    }

    public function store(Request $request)
    {
        $hasFile = $request->hasFile('ticket_file');
        if($hasFile){
            $file = $request->file('ticket_file');
            $filePath = Storage::disk('public')->putFile('ticket_files', $file);
            Ticket::create([
                'user_id' => Auth::user()->id,
                'subject' => request('subject'),
                'description' => request('description'),
                'admin_id' => 1,
                'category_id' => 1,
                'status_id' => 1,
                'priority_id' => 3,
                'ticket_file' => $filePath,
            ]);
        }
        else
        {
            Ticket::create([
                'user_id' => Auth::user()->id,
                'subject' => request('subject'),
                'description' => request('description'),
                'admin_id' => 1,
                'category_id' => 1,
                'status_id' => 1,
                'priority_id' => 3,
            ]);
        }
        Log::info("User: " . (Auth::user()->email) . " created Ticket Subject: ". $request['subject'] . ".");
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
            Log::info("User: " . (Auth::user()->email) . " viewed Ticket: ". $ticket->id . ".");
            return view('tickets.show', compact('ticket', 'username', 'category', 'status', 'priority', 'admin'));
        }
        else
        {
            Log::warning("User: " . (Auth::user()->email) . " cannot view Ticket: ". $ticket->id . ".");
            return view('tickets.403');
        }
    }

    public function edit(Ticket $ticket, Request $request)
    {
        if (Gate::allows('admin-ticket_access') || Gate::allows('staff-ticket_access'))
            {
                $categories = Category::pluck('title', 'id');
                $statuses = Status::pluck('title', 'id');
                $priorities = Priority::pluck('title', 'id');
                $admins = DB::table('users')->where('class_id','1')->pluck('name', 'id');
                Log::info("User: " . (Auth::user()->email) . " redirected to Edit Ticket: ". $ticket->id . ".");
                return view('tickets.edit', compact('ticket', 'categories', 'statuses', 'priorities', 'admins'));
            }
        else
        {
            Log::warning("User: " . (Auth::user()->email) . " cannot edit Ticket: ". $ticket->id . ".");
            return view('tickets.403');
        }
    }

    public function update(Request $request, Ticket $ticket)
    {
        DB::table('tickets')->where('id', $ticket->id)->update([
            'subject' => $request['subject'],
            'description' => $request['description'],
            'admin_id' => $request['admin_id'],
            'category_id' => $request['category_id'],
            'status_id' => $request['status_id'],
            'priority_id' => $request['priority_id'],
            'updated_at' => date("Y-m-d H:i:s"),
        ]);
        Log::info("User: " . (Auth::user()->email) . " updated Ticket: ". $ticket->id . ".");
        return redirect()->route(route:'tickets.index');
    }

    public function destroy(Ticket $ticket)
    {
        Log::info("User: " . (Auth::user()->email) . " deleted Ticket: ". $ticket->id . ".");
        $ticket->delete();
        return redirect()->route(route:'tickets.index');

    }
    public function restore($id)
    {
        Log::info("User: " . (Auth::user()->email) . " restored Ticket: ". $id . ".");
        Ticket::withTrashed()->find($id)->restore();
        return redirect()->route(route:'tickets.index');
    }
}
