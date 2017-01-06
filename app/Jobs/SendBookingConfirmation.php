<?php

namespace Javan\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Javan\AppMailer;
use Javan\Booking;

class SendBookingConfirmation extends Job implements ShouldQueue
{
	use InteractsWithQueue, SerializesModels;
	protected $booking;

	/**
	 * Create a new job instance.
	 *
	 * @param \Javan\Booking $booking
	 */
	public function __construct(Booking $booking)
	{
		$this->booking = $booking;
	}

	/**
	 * Create a new job instance.
	 *
	 * @param \Javan\AppMailer $mailer
	 */
	public function handle(AppMailer $mailer)
	{
		$mailer->sendEmailTo(
			$this->booking->user->email,
			$this->booking->load('user'. 'event')->toArray(),
			'Your Ticket',
			'emails.booking-confirmation'
		);
	}
}
