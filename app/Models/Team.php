<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Laratrust\Models\LaratrustTeam;

class Team extends LaratrustTeam
{
    protected $fillable = [
    	'name'
    ];

    public function hasSubscription()
    {
        return false;
    }

    public function ownedBy(User $user)
    {
    	return $this->users->find($user)->hasRole('team_admin', $this->id);
    }

    public function ownedByCurrentUser()
    {
    	return $this->ownedBy(auth()->user());
    }

    public function users()
    {
        return $this->belongsToMany(User::class)
                    ->withTimestamps();
    }
}
