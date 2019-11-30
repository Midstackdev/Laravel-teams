<?php

namespace App\Models;

use App\Models\Team;
use Laravel\Cashier\Subscription;

class TeamSubscription extends Subscription
{
    public function owner()
    {
        return $this->belongsTo(Team::class, (new Team)->getForeignKey());
    }
}
