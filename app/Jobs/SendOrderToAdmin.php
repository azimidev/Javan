<?php

namespace Javan\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Javan\AppMailer;
use Javan\ShoppingCart;

class SendOrderToAdmin extends Job implements ShouldQueue
{
	use InteractsWithQueue, SerializesModels;
	protected $cart;

	/**
	 * SendOrderToAdmin constructor.
	 *
	 * @param \Javan\ShoppingCart $cart
	 */
	public function __construct(ShoppingCart $cart)
	{
		$this->cart = $cart;
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
			$this->cart->load('user')->toArray(),
			'New Delivery Order',
			'emails.admin-order-notice'
		);
	}
}
