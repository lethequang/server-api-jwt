<?php

namespace App\Listeners;
use OwenIt\Auditing\Facades\Auditor;

class UserEventSubscriber
{
	/**
	 * Handle user login events.
	 */
	public function handleUserLogin($event) {
		Auditor::prune($event);
	}

	/**
	 * Handle user logout events.
	 */
	public function handleUserLogout($event) {

	}

	/**
	 * Register the listeners for the subscriber.
	 *
	 * @param  \Illuminate\Events\Dispatcher  $events
	 */
	public function subscribe($events)
	{
		$events->listen(
			'Illuminate\Auth\Events\Login',
			'App\Listeners\UserEventSubscriber@handleUserLogin'
		);

		$events->listen(
			'Illuminate\Auth\Events\Logout',
			'App\Listeners\UserEventSubscriber@handleUserLogout'
		);
	}
}