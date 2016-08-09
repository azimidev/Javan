<?php

namespace Javan\Http\Controllers\Auth;

use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Javan\Http\Controllers\Controller;
use Javan\User;
use Validator;

class AuthController extends Controller
{
	use AuthenticatesAndRegistersUsers, ThrottlesLogins;
	/**
	 * Where to redirect users after login / registration.
	 *
	 * @var string
	 */
	protected $redirectTo = '/member/profile';

	/**
	 * Create a new authentication controller instance.
	 */
	public function __construct()
	{
		$this->middleware($this->guestMiddleware(), ['except' => 'logout']);
	}

	/**
	 * Get a validator for an incoming registration request.
	 *
	 * @param  array $data
	 * @return \Illuminate\Contracts\Validation\Validator
	 */
	protected function validator(array $data)
	{
		return Validator::make($data, [
			'name'      => 'required|max:255',
			'email'     => 'required|email|max:255|unique:users',
			'password'  => 'required|min:6|confirmed',
			'address'   => 'required|min:3|max:255',
			'city'      => 'required|min:3|max:255',
			'post_code' => 'required|min:3|max:255',
			'phone'     => 'required|numeric',
		]);
	}

	/**
	 * Create a new user instance after a valid registration.
	 *
	 * @param  array $data
	 * @return User
	 */
	protected function create(array $data)
	{
		return User::create([
			'name'      => $data['name'],
			'email'     => $data['email'],
			'password'  => $data['password'],
			'address'   => $data['address'],
			'city'      => $data['city'],
			'post_code' => $data['post_code'],
			'phone'     => $data['phone'],
		]);
	}
}
