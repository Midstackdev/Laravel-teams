<?php

namespace App\Traits\Subscriptions;

trait HasSubscriptions 
{
	public function hasSubscription()
	{
	    return $this->subscribed('main');
	}
}