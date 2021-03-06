<?php

namespace App\Http\Controllers\Teams;

use App\Http\Controllers\Controller;
use App\Models\Team;
use App\Teams\Roles;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    public function __construct(Request $request)
    {
        $this->middleware('in_team:' . $request->team)
                ->except(['index', 'store']);

        $this->middleware(['permission:delete team,' . $request->team])
                ->only(['delete', 'destroy']);
    }

    public function index(Request $request)
    {
    	$teams = $request->user()->teams;
    	return view('teams.index', compact('teams'));
    }

    public function show(Team $team)
    {
    	return view('teams.show', compact('team'));
    }

    public function store(Request $request)
    {
    	$this->validate($request, [
    		'name' => 'required'
    	]);

    	$user = $request->user();

    	$team = $user->teams()->create($request->only('name'));

        $user->attachRole(Roles::$roleWhenCreatingTeam, $team->id);

    	return redirect()->route('teams.index');
    	
    }

    public function delete(Team $team)
    {
        return view('teams.delete', compact('team'));
    }

    public function destroy(Team $team)
    {
        $team->delete();

        return redirect()->route('teams.index');
    }
}
