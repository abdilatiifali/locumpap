<?php

namespace App\Traits;

trait HasBilling 
{
	public function charge()
	{
		$this->offerTrial();
	}

	/*
	* Offer three months trial for new organization
	*/
	public function offerTrial()
	{
		$this->update([
			'trial_ends_at' => now()->addMonths(3),
		]);
	}

	/*
	* determine if the Organization currently on trial period
	*/
	public function onTrial()
	{
		return $this->trial_ends_at->isFuture();
	}

	/*
	* determine if the Organization currently not on trial period
	*/ 
	public function notOnTrial()
	{
		return $this->trial_ends_at->isPast();
	}

	/*
	* End trial immediatly
	*/
	public function endTrial()
	{
		$this->update([
			'trial_ends_at' => now()->subMonths(10)
		]);
	}

	/*
	* Determine if the organization is subscribed or not
	*/
	public function subscribed()
	{
		if ($this->onTrial()) {
			return true;
		}

		if ($this->onSubscribed()) {
			return true;
		}

		return false;
	}

	/*
	* Determine if the organization is subscribed or not
	*/
	public function onSubscribed()
	{
		return $this->subscribed_at !== null && $this->subscription_ends_at->isFuture();
	}

}
