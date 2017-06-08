<?php

namespace Javan\Console\Commands;

use Illuminate\Console\Command;

class Clear extends Command
{
	/**
	 * The name and signature of the console command.
	 *
	 * @var string
	 */
	protected $signature = 'opcache:clear';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Clear the opcode cache';

	/**
	 * Create a new command instance.
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
		if (function_exists('opcache_reset') && opcache_reset()) {
			$this->info('Opcode cache cleared');
		} else {
			$this->line('Opcode cache: Nothing to clear');
		}
	}
}