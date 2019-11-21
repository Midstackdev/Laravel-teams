<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    public function scopeTeams(Builder $builder)
    {
    	return $builder->where('teams', 1);
    }
}
