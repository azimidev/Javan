<?php

namespace Javan\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Javan\User;

class UserPolicy
{
	use HandlesAuthorization;

	public function admin(User $user)
	{
		return $user->hasRole('admin');
	}

	public function manager(User $user)
	{
		return $user->hasRole('manager');
	}

	public function admin_manager(User $user)
	{
		return $user->hasRole(['admin', 'manager']);
	}

	public function member(User $user)
	{
		return $user->hasRole('member');
	}
}
