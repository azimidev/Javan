<?php

namespace Javan\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Javan\User;

class UserPolicy
{
	use HandlesAuthorization;

	/**
	 * @param \Javan\User $user
	 * @return bool
	 */
	public function admin(User $user)
	{
		return $user->hasRole('admin');
	}

	/**
	 * @param \Javan\User $user
	 * @return bool
	 */
	public function manager(User $user)
	{
		return $user->hasRole('manager');
	}

	/**
	 * @param \Javan\User $user
	 * @return bool
	 */
	public function admin_manager(User $user)
	{
		return $user->hasRole(['admin', 'manager']);
	}

	/**
	 * @param \Javan\User $user
	 * @return bool
	 */
	public function member(User $user)
	{
		return $user->hasRole('member');
	}
}
