<?php

namespace App\Listeners;
use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Logout;
use OwenIt\Auditing\Facades\Auditor;
use Illuminate\Support\Facades\DB;

class UserEventSubscriber
{
	/**
	 * Handle user login events.
	 */
	public function handleUserLogin(Login $event) {
		dd($event->user);
	}

	/**
	 * Handle user logout events.
	 */
	public function handleUserLogout(Logout $event) {
		dd('a');
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