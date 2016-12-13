<?php

namespace Javan\Http\Controllers;

use Illuminate\Http\Request;
use Javan\User;

class UsersController extends Controller
{
	/**
	 * UsersController constructor.
	 */
	public function __construct()
	{
		$this->middleware(['auth', 'admin']);
	}

	/**
	 * @return mixed
	 */
	public function index()
	{
		$users = User::isMember()->latest()->paginate(50);

		return view('user.index', compact('users'));
	}

	/**
	 * @return mixed
	 */
	public function adminIndex()
	{
		$users = User::isAdmin()->latest()->paginate(50);

		return view('user.index', compact('users'));
	}

	/**
	 * @return mixed
	 */
	public function managerIndex()
	{
		$users = User::isManager()->latest()->paginate(50);

		return view('user.index', compact('users'));
	}

	/**
	 * @return mixed
	 */
	public function create()
	{
		return view('user.create');
	}

	/**
	 * @param \Illuminate\Http\Request $request
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function store(Request $request)
	{
		$this->validate($request, [
			'name'     => 'required',
			'email'    => 'required|unique:users',
			'password' => 'required'
		]);
		User::create($request->all());
		flash()->success('Success', 'User was created');

		return back();
	}

	/**
	 * @param \Javan\User $user
	 * @return mixed
	 */
	public function edit(User $user)
	{
		return view('user.edit', compact('user'));
	}

	/**
	 * @param \Illuminate\Http\Request $request
	 * @param \Javan\User $user
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function update(Request $request, User $user)
	{
		$this->validate($request, [
			'name'  => 'required|min:3',
			'email' => 'required|email',
		]);

		$user->update($request->all());
		flash()->success('Success', 'Member\'s profile was updated');

		return back();
	}

	/**
	 * @param \Javan\User $user
	 * @return \Illuminate\Http\RedirectResponse
	 * @throws \Exception
	 */
	public function destroy(User $user)
	{
		$user->delete();
		flash()->success('Success', 'User was deleted');

		return back();
	}
}
