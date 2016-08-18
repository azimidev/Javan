<?php

namespace Javan\Billing;

use Cart;
use Exception;
use Stripe\Charge;
use Stripe\Stripe;

class StripeBilling implements BillingInterface
{
	/**
	 * StripeBilling constructor.
	 */
	public function __construct()
	{
		Stripe::setApiKey(env('STRIPE_SECRET'));
	}

	/**
	 * @param array $data
	 * @return mixed
	 */
	public function charge(array $data)
	{
		try {
			return Charge::create([
				'amount'      => Cart::total() * 100,
				'currency'    => 'gbp',
				'card'        => $data['token'],
				'description' => $data['email'],
			]);
		} catch (Exception $e) {
			return flash()->error('Error!', $e->getMessage());
		}
	}

	/**
	 * @param array $data
	 * @return mixed
	 */
	public function refund(array $data)
	{
		// TODO: Implement refund() method.
	}
}