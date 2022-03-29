<?php

namespace App\Http\Controllers;


use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Role;
use App\Models\User;
use App\Models\Classes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class UsersController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('query');
        abort_if(Gate::denies('user_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $users = User::with('roles')->get();
        if($query!=NULL)
        {
            $users = User::where('name', 'LIKE','%' . $query . '%' )->get();
        }
        Log::info("User: " . (Auth::user()->email) . " viewed User index.");
        return view('users.index', compact('users'));
    }

    public function create()
    {
        abort_if(Gate::denies('user_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $roles = Role::pluck('title', 'id');
        $classes= Classes::pluck('title', 'id');
        Log::info("User: " . (Auth::user()->email) . " redirected to User Create.");
        return view('users.create', compact('roles', 'classes'));
    }

    public function store(StoreUserRequest $request)
    {
        $user = User::create($request->validated());

        $user->roles()->sync($request->input('roles', []));

        Log::info("User: " . (Auth::user()->email) . " created User Name:". $request['name']);
        return redirect()->route('users.index');
    }

    public function show(User $user)
    {
        abort_if(Gate::denies('user_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        Log::info("User: " . (Auth::user()->email) . " viewed User ID: ". $user->id . ".");
        return view('users.show', compact('user'));
    }

    public function edit(User $user)
    {
        abort_if(Gate::denies('user_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $roles = Role::pluck('title', 'id');
        $user->load('roles');
        $classes = Classes::pluck('title', 'id');
        Log::info("User: " . (Auth::user()->email) . " redirected to User: ". $user->id . ".");
        return view('users.edit', compact('user', 'roles', 'classes'));
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        $user->update($request->validated());
        $user->roles()->sync($request->input('roles', []));
        DB::table('users')->where('id', $user->id)->update([
            'class_id' => $request['class_id'],
        ]);
        Log::info("User: " . (Auth::user()->email) . " updated User ID: ". $user->id . ".");
        return redirect()->route('users.index');
    }

    public function destroy(User $user)
    {
        abort_if(Gate::denies('user_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        Log::info("User: " . (Auth::user()->email) . " deleted User ID: ". $user->id . ".");
        $user->delete();
        return redirect()->route('users.index');
    }
}
