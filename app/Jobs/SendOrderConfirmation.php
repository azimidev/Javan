<?php

namespace Javan\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Javan\AppMailer;
use Javan\ShoppingCart;

class SendOrderConfirmation extends Job implements ShouldQueue
{
	use InteractsWithQueue, SerializesModels;
	protected $cart;

	/**
	 * Create a new job instance.
	 *
	 * @param \Javan\ShoppingCart $cart
	 */
	public function __construct(ShoppingCart $cart)
	{
		$this->cart = $cart;
	}

	/**
	 * Create a new job instance.
	 *
	 * @param \Javan\AppMailer $mailer
	 */
	public function handle(AppMailer $mailer)
	{
		$mailer->sendEmailTo(
			$this->cart->user->email,
			$this->cart->load('user')->toArray(),
			'Your Order Confirmation',
			'emails.order-confirmation'
		);
	}
}
