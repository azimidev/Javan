<?php

namespace Javan\Providers;

use Illuminate\Support\ServiceProvider;
use Javan\Billing\BillingInterface;
use Javan\Billing\StripeBilling;

class BillingServiceProvider extends ServiceProvider
{
	/**
	 * Bootstrap the application services.
	 *
	 * @return void
	 */
	public function boot()
	{
		app()->make(BillingInterface::class);
	}

	/**
	 * Register the application services.
	 *
	 * @return void
	 */
	public function register()
	{
		app()->bind(BillingInterface::class, StripeBilling::class);
	}
}
