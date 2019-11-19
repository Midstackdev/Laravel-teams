<?php

namespace App\Http\Controllers\Teams;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    public function index(Request $request)
    {
    	$teams = $request->user()->teams;
    	return view('teams.index', compact('teams'));
    }

    public function show()
    {
    	return view('teams.show');
    }

    public function store(Request $request)
    {
    	$this->validate($request, [
    		'name' => 'required'
    	]);

    	$user = $request->user();

    	$user->teams()->create($request->only('name'));

    	return redirect()->route('teams.index');
    	
    }
}
