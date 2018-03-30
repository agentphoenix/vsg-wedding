<?php namespace App\Console\Commands;

use Hash;
use App\User;
use Illuminate\Console\Command;

class SetUserPassword extends Command
{
	/**
	 * The name and signature of the console command.
	 *
	 * @var string
	 */
	protected $signature = 'wedding:set-user-password {user*} {--password=}';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Set a user password';

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
		if (count($this->argument('user')) < 2) {
			$this->error('Invalid name');
		} else {
			// Find the user
			$user = User::where('first_name', $this->argument('user')[0])
				->where('last_name', $this->argument('user')[1])
				->first();

			if (! $user) {
				$this->error('No user found');
			} else {
				// If we don't have anything in the password, set it null
				$password = (trim($this->option('password')) == '')
					? null
					: Hash::make(trim($this->option('password')));

				// Update the user's password
				$user->update(['password' => $password]);

				$this->info('Password changed!');
			}
		}
	}
}
