<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\Category;
use App\Models\Priority;
use App\Models\Status;
use App\Models\User;
use App\Models\Role;
use App\Notifications\CommentTicketNotification;
use App\Notifications\NewTicketNotification;
use App\Notifications\UpdatedTicketNotification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Database\Eloquent\Collection;
use Carbon\Carbon;

class TicketController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('query');
        $filter = $request->input('filter');
        $sort = $request->input('sortBy');
        if ($query===NULL && $filter===NULL && $sort===NULL)
        {
            $tickets = Ticket::all();
            if($request->has('view_deleted'))
            {
                abort_if(Gate::denies('user_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
                Log::info("User: " . (Auth::user()->email) . " viewed Ticket Archive index.");
                $tickets = Ticket::onlyTrashed()->get();
            }

            if(Gate::allows('ticket_access'))
            {
                $tickets = Ticket::where('user_id', Auth::user()->id)->get();
                Log::info("User: " . (Auth::user()->email) . " viewed Ticket User index.");
                return view('tickets.index', compact('tickets'));
            }
            elseif(Gate::allows('staff-ticket_access'))
            {
                $tickets = Ticket::where('admin_id', Auth::user()->id)->get();
                Log::info("User: " . (Auth::user()->email) . " viewed Ticket Staff index.");
                return view('tickets.staff', compact('tickets'));
            }
            Log::info("User: " . (Auth::user()->email) . " viewed Ticket Admin index.");
            return view('tickets.admin', compact('tickets'));
        }
        elseif($query!=NULL){
            if(Gate::allows('ticket_access'))
            {
                if(ctype_digit($query))
                {
                    $tickets = Ticket::where('user_id', Auth::user()->id)->where('id', 'LIKE','%' . $query . '%' )->get();
                    Log::info("User: " . (Auth::user()->email) . " searched for " . $query . " on Ticket User index.");
                    return view('tickets.index', compact('tickets'));
                }
                else
                {
                    $tickets = Ticket::where('user_id', Auth::user()->id)->where('subject', 'LIKE','%' . $query . '%' )->get();
                    Log::info("User: " . (Auth::user()->email) . " searched for " . $query . " on Ticket User index.");
                    return view('tickets.index', compact('tickets'));
                }
            }
            elseif(Gate::allows('staff-ticket_access'))
            {
                if(ctype_digit($query))
                {
                    $tickets = Ticket::where('admin_id', Auth::user()->id)->where('id', 'LIKE','%' . $query . '%' )->get();
                    Log::info("User: " . (Auth::user()->email) . " searched for " . $query . " on Ticket User index.");
                    return view('tickets.staff', compact('tickets'));
                }
                else
                {
                    $tickets = Ticket::where('admin_id', Auth::user()->id)->where('subject', 'LIKE','%' . $query . '%' )->get();
                    Log::info("User: " . (Auth::user()->email) . " searched for " . $query . " on Ticket User index.");
                    return view('tickets.staff', compact('tickets'));
                }
            }
            elseif(Gate::allows('admin-ticket_access'))
            {
                $tickets = Ticket::where('id', 'LIKE','%' . $query . '%' )->orWhere('subject', 'LIKE','%' . $query . '%' )->get();
                Log::info("User: " . (Auth::user()->email) . " searched for " . $query . " on Ticket Admin index.");
                return view('tickets.admin', compact('tickets'));
            }
        }
        elseif($filter!=NULL)
        {
            if($filter === 'priority-critical'){
                $tickets = Ticket::where('priority_id', 1)->get();
                if(Gate::allows('ticket_access'))
                {
                    $tickets = Ticket::where('user_id', Auth::user()->id)->where('priority_id', 1)->get();
                    Log::info("User: " . (Auth::user()->email) . " filtered for " . $filter . " on Ticket User index.");
                    return view('tickets.index', compact('tickets'));
                }
                elseif(Gate::allows('staff-ticket_access'))
                {
                    $tickets = Ticket::where('admin_id', Auth::user()->id)->where('priority_id', 1)->get();
                    Log::info("User: " . (Auth::user()->email) . " filtered for " . $filter . " on Ticket Staff index.");
                    return view('tickets.staff', compact('tickets'));
                }
                Log::info("User: " . (Auth::user()->email) . " filtered for " . $filter . " on Ticket Admin index.");
                return view('tickets.admin', compact('tickets'));
            }
            elseif($filter === 'priority-high')
            {
                $tickets = Ticket::where('priority_id', 2)->get();
                if(Gate::allows('ticket_access'))
                {
                    $tickets = Ticket::where('user_id', Auth::user()->id)->where('priority_id', 2)->get();
                    Log::info("User: " . (Auth::user()->email) . " filtered for " . $filter . " on Ticket User index.");
                    return view('tickets.index', compact('tickets'));
                }
                elseif(Gate::allows('staff-ticket_access')){
                    $tickets = Ticket::where('admin_id', Auth::user()->id)->where('priority_id', 2)->get();
                    Log::info("User: " . (Auth::user()->email) . " filtered for " . $filter . " on Ticket Staff index.");
                    return view('tickets.staff', compact('tickets'));
                }
                Log::info("User: " . (Auth::user()->email) . " filtered for " . $filter . " on Ticket Admin index.");
                return view('tickets.admin', compact('tickets'));
            }
            elseif($filter === 'priority-medium')
            {
                $tickets = Ticket::where('priority_id', 3)->get();
                if(Gate::allows('ticket_access'))
                {
                    $tickets = Ticket::where('user_id', Auth::user()->id)->where('priority_id', 3)->get();
                    Log::info("User: " . (Auth::user()->email) . " filtered for " . $filter . " on Ticket User index.");
                    return view('tickets.index', compact('tickets'));
                }
                elseif(Gate::allows('staff-ticket_access'))
                {
                    $tickets = Ticket::where('admin_id', Auth::user()->id)->where('priority_id', 3)->get();
                    Log::info("User: " . (Auth::user()->email) . " filtered for " . $filter . " on Ticket Staff index.");
                    return view('tickets.staff', compact('tickets'));
                }
                Log::info("User: " . (Auth::user()->email) . " filtered for " . $filter . " on Ticket Admin index.");
                return view('tickets.admin', compact('tickets'));
            }
            elseif($filter === 'priority-low')
            {
                $tickets = Ticket::where('priority_id', 4)->get();
                if(Gate::allows('ticket_access'))
                {
                    $tickets = Ticket::where('user_id', Auth::user()->id)->where('priority_id', 4)->get();
                    Log::info("User: " . (Auth::user()->email) . " filtered for " . $filter . " on Ticket User index.");
                    return view('tickets.index', compact('tickets'));
                }
                elseif(Gate::allows('staff-ticket_access')){
                    $tickets = Ticket::where('admin_id', Auth::user()->id)->where('priority_id', 4)->get();
                    Log::info("User: " . (Auth::user()->email) . " filtered for " . $filter . " on Ticket Staff index.");
                    return view('tickets.staff', compact('tickets'));
                }
                Log::info("User: " . (Auth::user()->email) . " filtered for " . $filter . " on Ticket Admin index.");
                return view('tickets.admin', compact('tickets'));
            }
            elseif($filter === 'status-open')
            {
                $tickets = Ticket::where('status_id', 1)->get();
                if(Gate::allows('ticket_access'))
                {
                    $tickets = Ticket::where('user_id', Auth::user()->id)->where('status_id', 1)->get();
                    Log::info("User: " . (Auth::user()->email) . " filtered for " . $filter . " on Ticket User index.");
                    return view('tickets.index', compact('tickets'));
                }
                elseif(Gate::allows('staff-ticket_access')){
                    $tickets = Ticket::where('admin_id', Auth::user()->id)->where('status_id', 1)->get();
                    Log::info("User: " . (Auth::user()->email) . " filtered for " . $filter . " on Ticket Staff index.");
                    return view('tickets.staff', compact('tickets'));
                }
                Log::info("User: " . (Auth::user()->email) . " filtered for " . $filter . " on Ticket Admin index.");
                return view('tickets.admin', compact('tickets'));
            }
            elseif($filter === 'status-in_progress')
            {
                $tickets = Ticket::where('status_id', 2)->get();
                if(Gate::allows('ticket_access'))
                {
                    $tickets = Ticket::where('user_id', Auth::user()->id)->where('status_id', 2)->get();
                    Log::info("User: " . (Auth::user()->email) . " filtered for " . $filter . " on Ticket User index.");
                    return view('tickets.index', compact('tickets'));
                }
                elseif(Gate::allows('staff-ticket_access')){
                    $tickets = Ticket::where('admin_id', Auth::user()->id)->where('status_id', 2)->get();
                    Log::info("User: " . (Auth::user()->email) . " filtered for " . $filter . " on Ticket Staff index.");
                    return view('tickets.staff', compact('tickets'));
                }
                Log::info("User: " . (Auth::user()->email) . " filtered for " . $filter . " on Ticket Admin index.");
                return view('tickets.admin', compact('tickets'));
            }
            elseif($filter === 'status-closed')
            {
                $tickets = Ticket::where('status_id', 3)->get();
                if(Gate::allows('ticket_access'))
                {
                    $tickets = Ticket::where('user_id', Auth::user()->id)->where('status_id', 3)->get();
                    Log::info("User: " . (Auth::user()->email) . " filtered for " . $filter . " on Ticket User index.");
                    return view('tickets.index', compact('tickets'));
                }
                elseif(Gate::allows('staff-ticket_access')){
                    $tickets = Ticket::where('admin_id', Auth::user()->id)->where('status_id', 3)->get();
                    Log::info("User: " . (Auth::user()->email) . " filtered for " . $filter . " on Ticket Staff index.");
                    return view('tickets.staff', compact('tickets'));
                }
                Log::info("User: " . (Auth::user()->email) . " filtered for " . $filter . " on Ticket Admin index.");
                return view('tickets.admin', compact('tickets'));
            }
            elseif($filter === 'category-uncategorized')
            {
                $tickets = Ticket::where('category_id', 1)->get();
                if(Gate::allows('ticket_access'))
                {
                    $tickets = Ticket::where('user_id', Auth::user()->id)->where('category_id', 1)->get();
                    Log::info("User: " . (Auth::user()->email) . " filtered for " . $filter . " on Ticket User index.");
                    return view('tickets.index', compact('tickets'));
                }
                elseif(Gate::allows('staff-ticket_access')){
                    $tickets = Ticket::where('admin_id', Auth::user()->id)->where('category_id', 1)->get();
                    Log::info("User: " . (Auth::user()->email) . " filtered for " . $filter . " on Ticket Staff index.");
                    return view('tickets.staff', compact('tickets'));
                }
                Log::info("User: " . (Auth::user()->email) . " filtered for " . $filter . " on Ticket Admin index.");
                return view('tickets.admin', compact('tickets'));
            }
            elseif($filter === 'category-pu_official_website')
            {
                $tickets = Ticket::where('category_id', 2)->get();
                if(Gate::allows('ticket_access'))
                {
                    $tickets = Ticket::where('user_id', Auth::user()->id)->where('category_id', 2)->get();
                    Log::info("User: " . (Auth::user()->email) . " filtered for " . $filter . " on Ticket User index.");
                    return view('tickets.index', compact('tickets'));
                }
                elseif(Gate::allows('staff-ticket_access')){
                    $tickets = Ticket::where('admin_id', Auth::user()->id)->where('category_id', 2)->get();
                    Log::info("User: " . (Auth::user()->email) . " filtered for " . $filter . " on Ticket Staff index.");
                    return view('tickets.staff', compact('tickets'));
                }
                Log::info("User: " . (Auth::user()->email) . " filtered for " . $filter . " on Ticket Admin index.");
                return view('tickets.admin', compact('tickets'));
            }
            elseif($filter === 'category-aims')
            {
                $tickets = Ticket::where('category_id', 3)->get();
                if(Gate::allows('ticket_access'))
                {
                    $tickets = Ticket::where('user_id', Auth::user()->id)->where('category_id', 3)->get();
                    Log::info("User: " . (Auth::user()->email) . " filtered for " . $filter . " on Ticket User index.");
                    return view('tickets.index', compact('tickets'));
                }
                elseif(Gate::allows('staff-ticket_access')){
                    $tickets = Ticket::where('admin_id', Auth::user()->id)->where('category_id', 3)->get();
                    Log::info("User: " . (Auth::user()->email) . " filtered for " . $filter . " on Ticket Staff index.");
                    return view('tickets.staff', compact('tickets'));
                }
                Log::info("User: " . (Auth::user()->email) . " filtered for " . $filter . " on Ticket Admin index.");
                return view('tickets.admin', compact('tickets'));
            }
            elseif($filter === 'category-google_classroom')
            {
                $tickets = Ticket::where('category_id', 4)->get();
                if(Gate::allows('ticket_access'))
                {
                    $tickets = Ticket::where('user_id', Auth::user()->id)->where('category_id', 4)->get();
                    Log::info("User: " . (Auth::user()->email) . " filtered for " . $filter . " on Ticket User index.");
                    return view('tickets.index', compact('tickets'));
                }
                elseif(Gate::allows('staff-ticket_access')){
                    $tickets = Ticket::where('admin_id', Auth::user()->id)->where('category_id', 4)->get();
                    Log::info("User: " . (Auth::user()->email) . " filtered for " . $filter . " on Ticket Staff index.");
                    return view('tickets.staff', compact('tickets'));
                }
                Log::info("User: " . (Auth::user()->email) . " filtered for " . $filter . " on Ticket Admin index.");
                return view('tickets.admin', compact('tickets'));
            }
            elseif($filter === 'category-pu_email')
            {
                $tickets = Ticket::where('category_id', 5)->get();
                if(Gate::allows('ticket_access'))
                {
                    $tickets = Ticket::where('user_id', Auth::user()->id)->where('category_id', 5)->get();
                    Log::info("User: " . (Auth::user()->email) . " filtered for " . $filter . " on Ticket User index.");
                    return view('tickets.index', compact('tickets'));
                }
                elseif(Gate::allows('staff-ticket_access')){
                    $tickets = Ticket::where('admin_id', Auth::user()->id)->where('category_id', 5)->get();
                    Log::info("User: " . (Auth::user()->email) . " filtered for " . $filter . " on Ticket Staff index.");
                    return view('tickets.staff', compact('tickets'));
                }
                Log::info("User: " . (Auth::user()->email) . " filtered for " . $filter . " on Ticket Admin index.");
                return view('tickets.admin', compact('tickets'));
            }
            elseif($filter === 'category-computer_laboratory')
            {
                $tickets = Ticket::where('category_id', 6)->get();
                if(Gate::allows('ticket_access'))
                {
                    $tickets = Ticket::where('user_id', Auth::user()->id)->where('category_id', 6)->get();
                    Log::info("User: " . (Auth::user()->email) . " filtered for " . $filter . " on Ticket User index.");
                    return view('tickets.index', compact('tickets'));
                }
                elseif(Gate::allows('staff-ticket_access')){
                    $tickets = Ticket::where('admin_id', Auth::user()->id)->where('category_id', 6)->get();
                    Log::info("User: " . (Auth::user()->email) . " filtered for " . $filter . " on Ticket Staff index.");
                    return view('tickets.staff', compact('tickets'));
                }
                Log::info("User: " . (Auth::user()->email) . " filtered for " . $filter . " on Ticket Admin index.");
                return view('tickets.admin', compact('tickets'));
            }
            elseif($filter === 'category-school_wifi')
            {
                $tickets = Ticket::where('category_id', 7)->get();
                if(Gate::allows('ticket_access'))
                {
                    $tickets = Ticket::where('user_id', Auth::user()->id)->where('category_id', 7)->get();
                    Log::info("User: " . (Auth::user()->email) . " filtered for " . $filter . " on Ticket User index.");
                    return view('tickets.index', compact('tickets'));
                }
                elseif(Gate::allows('staff-ticket_access')){
                    $tickets = Ticket::where('admin_id', Auth::user()->id)->where('category_id', 7)->get();
                    Log::info("User: " . (Auth::user()->email) . " filtered for " . $filter . " on Ticket Staff index.");
                    return view('tickets.staff', compact('tickets'));
                }
                Log::info("User: " . (Auth::user()->email) . " filtered for " . $filter . " on Ticket Admin index.");
                return view('tickets.admin', compact('tickets'));
            }
            elseif($filter === 'category-others')
            {
                $tickets = Ticket::where('category_id', 8)->get();
                if(Gate::allows('ticket_access'))
                {
                    $tickets = Ticket::where('user_id', Auth::user()->id)->where('category_id', 8)->get();
                    Log::info("User: " . (Auth::user()->email) . " filtered for " . $filter . " on Ticket User index.");
                    return view('tickets.index', compact('tickets'));
                }
                elseif(Gate::allows('staff-ticket_access')){
                    $tickets = Ticket::where('admin_id', Auth::user()->id)->where('category_id', 8)->get();
                    Log::info("User: " . (Auth::user()->email) . " filtered for " . $filter . " on Ticket Staff index.");
                    return view('tickets.staff', compact('tickets'));
                }
                Log::info("User: " . (Auth::user()->email) . " filtered for " . $filter . " on Ticket Admin index.");
                return view('tickets.admin', compact('tickets'));
            }
        }
        else
        {
            if ($sort === 'descending-ticket_id' || $sort === 'recently_created')
            {
                $tickets = Ticket::all()->sortByDesc('id');
                if (Gate::allows('ticket_access')) {
                    $tickets = Ticket::where('user_id', Auth::user()->id)->orderBy('id','desc')->get();
                    Log::info("User: " . (Auth::user()->email) . " sorted for " . $sort . " on Ticket User index.");
                    return view('tickets.index', compact('tickets'));
                } elseif (Gate::allows('staff-ticket_access')) {
                    $tickets = Ticket::where('admin_id', Auth::user()->id)->orderBy('id','desc')->get();
                    Log::info("User: " . (Auth::user()->email) . " sorted for " . $sort . " on Ticket Staff index.");
                    return view('tickets.staff', compact('tickets'));
                }
                Log::info("User: " . (Auth::user()->email) . " sorted for " . $sort . " on Ticket Admin index.");
                return view('tickets.admin', compact('tickets'));
            }
            elseif($sort === 'recently_updated')
            {
                $tickets = Ticket::all()->sortByDesc('updated_at');
                if (Gate::allows('ticket_access'))
                {
                    $tickets = Ticket::where('user_id', Auth::user()->id)->orderBy('updated_at','desc')->get();
                    Log::info("User: " . (Auth::user()->email) . " sorted for " . $sort . " on Ticket User index.");
                    return view('tickets.index', compact('tickets'));
                }
                elseif (Gate::allows('staff-ticket_access'))
                {
                    $tickets = Ticket::where('admin_id', Auth::user()->id)->orderBy('updated_at','desc')->get();
                    Log::info("User: " . (Auth::user()->email) . " sorted for " . $sort . " on Ticket Staff index.");
                    return view('tickets.staff', compact('tickets'));
                }
                Log::info("User: " . (Auth::user()->email) . " sorted for " . $sort . " on Ticket Admin index.");
                return view('tickets.admin', compact('tickets'));

            }
            elseif($sort === 'not_recently_updated')
            {
                $tickets = Ticket::all()->sortBy('updated_at');
                if (Gate::allows('ticket_access'))
                {
                    $tickets = Ticket::where('user_id', Auth::user()->id)->orderBy('updated_at','asc')->get();
                    Log::info("User: " . (Auth::user()->email) . " sorted for " . $sort . " on Ticket User index.");
                    return view('tickets.index', compact('tickets'));
                } elseif (Gate::allows('staff-ticket_access'))
                {
                    $tickets = Ticket::where('admin_id', Auth::user()->id)->orderBy('updated_at','asc')->get();
                    Log::info("User: " . (Auth::user()->email) . " sorted for " . $sort . " on Ticket Staff index.");
                    return view('tickets.staff', compact('tickets'));
                }
                Log::info("User: " . (Auth::user()->email) . " sorted for " . $sort . " on Ticket Admin index.");
                return view('tickets.admin', compact('tickets'));

            }
            else
            {
                $tickets = Ticket::all();
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
            $admin = DB::table('users')->where('id', 1)->value('id');
            $file = $request->file('ticket_file');
            $filePath = Storage::disk('public')->putFile('ticket_files', $file);
            $ticket = Ticket::create([
                'user_id' => Auth::user()->id,
                'subject' => request('subject'),
                'description' => request('description'),
                'admin_id' => 1,
                'category_id' => 1,
                'status_id' => 1,
                'priority_id' => 3,
                'ticket_file' => $filePath,
            ]);
            User::find($admin)->notify(new NewTicketNotification($ticket));
        }
        else
        {
            $admin = DB::table('users')->where('id', 1)->value('id');
            $ticket = Ticket::create([
                'user_id' => Auth::user()->id,
                'subject' => request('subject'),
                'description' => request('description'),
                'admin_id' => 1,
                'category_id' => 1,
                'status_id' => 1,
                'priority_id' => 3,
            ]);
            User::find($admin)->notify(new NewTicketNotification($ticket));

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

            $comments = DB::table('comments')->where('ticket_id', $ticket->id)->orderBy('created_at','asc')->get();

            return view('tickets.show', compact('ticket', 'username', 'category', 'status', 'priority', 'admin', 'comments'));
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

        $admin = DB::table('tickets')->where('id', $ticket->id)->value('admin_id');
        $user = DB::table('tickets')->where('id', $ticket->id)->value('user_id');
        if((Auth::user()->id) === (DB::table('tickets')->where('id', $ticket->id)->value('user_id')))
        {
            User::find($admin)->notify(new UpdatedTicketNotification());
        }
        elseif ((Auth::user()->id) === (DB::table('tickets')->where('id', $ticket->id)->value('admin_id')))
        {
            User::find($user)->notify(new UpdatedTicketNotification());
        }
        elseif ($admin === $user)
        {
            User::find($admin)->notify(new UpdatedTicketNotification());
        }
        else
        {
            User::find($user)->notify(new UpdatedTicketNotification());
        }

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
