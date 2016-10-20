<?php

namespace Javan\Billing;

use Exception;
use Stripe\Charge;
use Stripe\Refund;
use Stripe\Stripe;

class StripeBilling implements BillingInterface
{
	/**
	 * StripeBilling constructor.
	 */
	public function __construct()
	{
		Stripe::setApiKey(config('services.stripe.secret'));
	}

	/**
	 * @param array $data
	 * @return mixed
	 */
	public function charge(array $data)
	{
		try {
			return Charge::create([
				'amount'      => $data['total'],
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
		try {
			return Refund::create(['charge' => $data['charge']]);
		} catch (Exception $e) {
			return flash()->error('Error!', $e->getMessage());
		}
	}
}