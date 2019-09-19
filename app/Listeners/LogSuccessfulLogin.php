<?php

namespace App\Listeners;

use http\Env\Request;
use Illuminate\Auth\Events\Login;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class LogSuccessfulLogin
{
	/**
	 * @var Request
	 *
	 */
	protected $request;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(Login $event)
    {
    	die('a');
		$user = $event->user;
		$user->last_login_at = date('Y-m-d H:i:s');
		$user->last_login_ip = $this->request->ip();
		$user->save();
    }
}
