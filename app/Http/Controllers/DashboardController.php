<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Gate;

class DashboardController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('dashboard_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $usercount = DB::table('users')->count();
        $ticketcount = DB::table('tickets')->count();
        $opencount = DB::table('tickets')->where('status_id', '1')->count();
        $inprogresscount = DB::table('tickets')->where('status_id', '2')->count();
        $closecount = DB::table('tickets')->where('status_id', '3')->count();
        $criticalcount = DB::table('tickets')->where('priority_id', '1')->count();
        $highcount = DB::table('tickets')->where('priority_id', '2')->count();
        $mediumcount = DB::table('tickets')->where('priority_id', '3')->count();
        $lowcount = DB::table('tickets')->where('priority_id', '4')->count();
        $uccount = DB::table('tickets')->where('category_id', '1')->count();
        $puowcount = DB::table('tickets')->where('category_id', '2')->count();
        $aimscount = DB::table('tickets')->where('category_id', '3')->count();
        $gccount = DB::table('tickets')->where('category_id', '4')->count();
        $puecount = DB::table('tickets')->where('category_id', '5')->count();
        $clcount = DB::table('tickets')->where('category_id', '6')->count();
        $swcount = DB::table('tickets')->where('category_id', '7')->count();


        return view('dashboard.index', compact('usercount', 'ticketcount', 'opencount', 'inprogresscount', 'closecount', 'criticalcount', 'highcount', 'mediumcount', 'lowcount', 'uccount', 'puowcount', 'aimscount', 'gccount', 'puecount', 'clcount', 'swcount'));
    }
}
