<?php

namespace Javan\Http\Controllers\Auth;

use Auth;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Support\Str;
use Javan\Http\Controllers\Controller;

class PasswordController extends Controller
{
	/*
	|--------------------------------------------------------------------------
	| Password Reset Controller
	|--------------------------------------------------------------------------
	|
	| This controller is responsible for handling password reset requests
	| and uses a simple trait to include this behavior. You're free to
	| explore this trait and override any methods you wish to tweak.
	|
	*/

	use ResetsPasswords;
	protected $redirectTo = '/member/profile';

	/**
	 * Create a new password controller instance.
	 */
	public function __construct()
	{
		$this->middleware('guest');
	}

	/**
	 * @param $user
	 * @param $password
	 */
	protected function resetPassword($user, $password)
	{
		$user->forceFill([
			'password'       => $password,
			'remember_token' => Str::random(60),
		])->save();

		Auth::guard($this->getGuard())->login($user);
	}
}
