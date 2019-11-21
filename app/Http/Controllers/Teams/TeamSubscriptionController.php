<?php

namespace App\Http\Controllers\Teams;

use App\Http\Controllers\Controller;
use App\Models\Plan;
use App\Models\Team;
use Illuminate\Http\Request;

class TeamSubscriptionController extends Controller
{
    public function index(Team $team)
    {
    	$plans = Plan::teams()->get();
    	return view('teams.subscriptions.index', compact('team', 'plans'));
    }

    public function store(Request $request, Team $team)
    {
    	dd($request->only(['token', 'plan']));
    }
}
