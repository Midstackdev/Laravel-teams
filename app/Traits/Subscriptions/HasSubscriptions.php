<?php

namespace App\Traits\Subscriptions;

trait HasSubscriptions 
{
	public function hasSubscription()
	{
	    return $this->subscribed('main');
	}

	public function isOnPlan($plan)
	{
		return $this->subscribedToPlan($plan, 'main');
	}

	public function currentSubscription()
	{
		return $this->subscription('main');
	}
}