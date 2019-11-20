<?php

namespace App\Http\Controllers\Teams;

use App\Http\Controllers\Controller;
use App\Models\Team;
use App\Models\User;
use App\Teams\Roles;
use Illuminate\Http\Request;

class TeamUserController extends Controller
{
	public function __construct(Request $request)
	{
		$this->middleware('in_team:' . $request->team);

	    $this->middleware(['permission:add users,' . $request->team])
	            ->only(['store']);
	}

    public function index(Team $team)
    {
    	return view('teams.users.index', compact('team'));
    }

    public function store(Request $request, Team $team)
    {
    	$this->validate($request, [
    		'email' => 'required|exists:users,email'
    	]);

    	$team->users()->syncWithoutDetaching(
    		$user = User::where('email', $request->email)->first()
    	);

    	$user->attachRole(Roles::$roleWhenJoiningTeam, $team->id);

    	return back();
    }
}
