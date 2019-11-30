<?php

namespace App\Models;

use App\Models\TeamSubscription;
use App\Traits\Subscriptions\HasSubscriptions;
use Illuminate\Database\Eloquent\Model;
use Laratrust\Models\LaratrustTeam;
use Laravel\Cashier\Billable;

class Team extends LaratrustTeam
{
    use Billable, HasSubscriptions;

    protected $fillable = [
    	'name'
    ];

    public function ownedBy(User $user)
    {
    	return $this->users->find($user)->hasRole('team_admin', $this->id);
    }

    public function ownedByCurrentUser()
    {
    	return $this->ownedBy(auth()->user());
    }

    public function getPlanAttribute()
    {
        return $this->plans->first();
    }

    public function users()
    {
        return $this->belongsToMany(User::class)
                    ->withTimestamps();
    }

    public function subscriptions()
    {
        return $this->hasMany(TeamSubscription::class, $this->getForeignKey())->orderBy('created_at', 'desc');
    }

    public function plans()
    {
        return $this->hasManyThrough(Plan::class, TeamSubscription::class, 'team_id', 'provider_id', 'id', 'stripe_plan')
                    ->orderBy('team_subscriptions.created_at', 'desc');
    }
}
