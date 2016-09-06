<?php

namespace Javan\Http\Middleware;

use Closure;

class MustBeActive
{
	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @param  \Closure $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
		if ( ! $request->user()->active) {
			if ($request->ajax() || $request->wantsJson()) {
				return response('Profile Deactivated!', 403);
			}

			auth()->logout();
			flash()->overlay('Profile Deactivated!', 'You profile have been deactivated by admins for some reason!', 'error');

			return back();
		}

		return $next($request);
	}
}
