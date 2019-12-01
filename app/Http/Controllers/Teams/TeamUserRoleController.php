<?php

namespace App\Http\Controllers\Teams;

use App\Http\Controllers\Controller;
use App\Models\Team;
use App\Models\User;
use App\Teams\Roles;
use Illuminate\Http\Request;

class TeamUserRoleController extends Controller
{
	public function __construct(Request $request)
	{
		$this->middleware('in_team:' . $request->team);

		$this->middleware(['permission:change user role,' . $request->team]);
	}

    public function edit(Team $team, User $user)
    {
    	$roles = Roles::$roles;
    	return view('teams.users.roles.edit', compact('team', 'user', 'roles'));
    }

    public function update(Request $request, Team $team, User $user)
    {
    	$this->validate($request, [
    		'role' => 'required|exists:roles,name'
    	]);

    	if (!$team->users->contains($user)) {
    	    return back();
    	}

    	if ($user->isOnlyAdminInTeam($team)) {
    	    return back();
    	}

    	$user->syncRoles([$request->role], $team->id);

    	return redirect()->route('teams.users.index', $team);
    }
}
