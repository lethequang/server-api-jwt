<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class AuditRewrite extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'audit:rewrite';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Rewrite audit logs';

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
    	self::backupLogs();
    	$this->info('Backup audit logs successfully');
    }

    public function backupLogs() {

    	$query = DB::table('audits')->whereDate('created_at', date('Y-m-d'));

    	$records = $query->get()->toArray();

    	foreach ($records as $record) {

    		$auditType = $record->auditable_type;

    		DB::table("audits_{$this->detectModel($auditType)}")->insert($this->formatData($record));
		}

		$query->delete();

	}

	public function detectModel($path) {
		return basename($path);
	}

	public function formatData($data) {
    	return json_decode(json_encode($data), true);
    }

}
