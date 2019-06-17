<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class TodayUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'today-users:check';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check user updated';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
		$time = date('i');
		$user = DB::table('users')
			->where('id', $time);
		if (!($user->first())) {
			echo "Not found user with id $time";
		} else {
			$user->update(['email' => 'edit_in_' . date('i') . '@gmail.com']);
			echo " User $time has been updated";
		}
    }
}
