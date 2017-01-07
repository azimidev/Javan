<?php

namespace Javan\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Javan\AppMailer;
use Javan\Booking;

class SendBookingToAdmin extends Job implements ShouldQueue
{
	use InteractsWithQueue, SerializesModels;
	protected $booking;

	/**
	 * SendBookingToAdmin constructor.
	 *
	 * @param \Javan\Booking $booking
	 */
	public function __construct(Booking $booking)
	{
		$this->booking = $booking;
	}

	/**
	 * Execute the job.
	 *
	 * @param \Javan\AppMailer $mailer
	 */
	public function handle(AppMailer $mailer)
	{
		$mailer->sendEmailTo(
			env('PRINTER_EMAIL'),
			$this->booking->load('user', 'event')->toArray(),
			'New Ticket Purchase',
			'emails.admin-booking-notice'
		);
	}
}
