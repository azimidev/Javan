<?php

namespace Javan\Billing;

interface BillingInterface
{
	/**
	 * @param array $data
	 * @return mixed
	 */
	public function charge(array $data);

	/**
	 * @param array $data
	 * @return mixed
	 */
	public function refund(array $data);
}