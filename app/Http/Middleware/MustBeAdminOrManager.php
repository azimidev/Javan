<?php

namespace Javan\Http\Middleware;

use Closure;
use Gate;

class MustBeAdminOrManager
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
	    Gate::authorize('admin_manager', $request->user());

	    return $next($request);
    }
}
