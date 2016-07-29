<?php

use Illuminate\Database\Seeder;
use Javan\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::truncate();

	    factory(Role::class, 5)->create();
    }
}
