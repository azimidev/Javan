<?php

namespace Javan\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Javan\AppMailer;
use Javan\Reservation;

class SendReservationToAdmin extends Job implements ShouldQueue
{
	use InteractsWithQueue, SerializesModels;
	protected $reservation;

	/**
	 * Create a new job instance.
	 *
	 * @param \Javan\Reservation $reservation
	 */
	public function __construct(Reservation $reservation)
	{
		$this->reservation = $reservation;
	}

	/**
	 * Execute the job.
	 *
	 * @param \Javan\AppMailer $mailer
	 */
	public function handle(AppMailer $mailer)
	{
		$mailer->sendReservationToAdmin(
			env('PRINTER_EMAIL'), $this->reservation->load('user')->toArray()
		);
	}
}
