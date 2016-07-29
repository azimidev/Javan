<?php

use Illuminate\Database\Seeder;
use Javan\User;

class UsersTableSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		User::truncate();

		factory(User::class, 10)->create();
	}
}
