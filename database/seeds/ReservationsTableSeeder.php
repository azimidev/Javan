<?php

use Illuminate\Database\Seeder;
use Javan\Reservation;

class ReservationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
	    Reservation::truncate();

	    factory(Reservation::class, 10)->create();
    }
}
