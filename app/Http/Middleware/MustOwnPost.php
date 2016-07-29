<?php

namespace Javan\Http\Middleware;

use Closure;

class MustOwnPost
{
	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @param  \Closure $next
	 * @return mixed
	 * @throws \Illuminate\Auth\Access\AuthorizationException
	 */
	public function handle($request, Closure $next)
	{
		if ( ! $request->user()->owns($request->post)) {

			if ($request->ajax()) {
				return response(['message' => 'Unauthorized Action!'], 403);
			}

			flash()->error('Unauthorized Action!', 'You are not authorized to do this action');

			return back();
		}

		return $next($request);
	}
}
