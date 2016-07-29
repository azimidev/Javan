<?php

namespace Javan\Http\Middleware;

use Closure;
use Gate;

class MustBeManager
{
	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @param  \Closure                 $next
	 * @return mixed
	 * @throws \Illuminate\Auth\Access\AuthorizationException
	 */
	public function handle($request, Closure $next)
	{
		Gate::authorize('manager', $request->user());

		return $next($request);
	}
}
