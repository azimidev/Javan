<?php

namespace Javan\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
	/**
	 * The application's global HTTP middleware stack.
	 * These middleware are run during every request to your application.
	 *
	 * @var array
	 */
	protected $middleware = [
		\Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode::class,
		\Spatie\Pjax\Middleware\FilterIfPjax::class,
	];
	/**
	 * The application's route middleware groups.
	 *
	 * @var array
	 */
	protected $middlewareGroups = [
		'web' => [
			\Javan\Http\Middleware\EncryptCookies::class,
			\Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
			\Illuminate\Session\Middleware\StartSession::class,
			\Illuminate\View\Middleware\ShareErrorsFromSession::class,
			\Javan\Http\Middleware\VerifyCsrfToken::class,
			// \Javan\Http\Middleware\PjaxMiddleware::class,
		],

		'api' => [
			'throttle:60,1',
		],
	];
	/**
	 * The application's route middleware.
	 * These middleware may be assigned to groups or used individually.
	 *
	 * @var array
	 */
	protected $routeMiddleware = [
		'must.own.post' => \Javan\Http\Middleware\MustOwnPost::class,
		'auth'          => \Javan\Http\Middleware\Authenticate::class,
		'admin'         => \Javan\Http\Middleware\MustBeAdmin::class,
		'manager'       => \Javan\Http\Middleware\MustBeManager::class,
		'admin.manager' => \Javan\Http\Middleware\MustBeAdminOrManager::class,
		'auth.basic'    => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
		'can'           => \Illuminate\Foundation\Http\Middleware\Authorize::class,
		'guest'         => \Javan\Http\Middleware\RedirectIfAuthenticated::class,
		'throttle'      => \Illuminate\Routing\Middleware\ThrottleRequests::class,
	];
}
