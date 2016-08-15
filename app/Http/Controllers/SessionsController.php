<?php

namespace Javan\Http\Controllers;

use Illuminate\Http\Request;
use Javan\Reservation;

class SessionsController extends Controller
{
	protected $user;

	/**
	 * SessionsController constructor.
	 */
	public function __construct()
	{
		$this->middleware(['auth']);

		$this->user = auth()->user();
	}

	/**
	 * Display the specified resource.
	 *
	 * @return mixed
	 */
	public function show()
	{
		return view('user.profile', ['user' => $this->user]);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function edit()
	{
		return view('user.member-edit-profile', ['user' => $this->user]);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request)
	{
		$this->validate($request, [
			'name'      => 'required',
			'email'     => 'required|email',
			'address'   => 'required',
			'city'      => 'required',
			'post_code' => 'required',
			'phone'     => 'required|numeric',
		]);

		$this->user->update($request->all());
		flash()->success('Success', 'Profile has been updated successfully');

		return back();
	}

	/**
	 * @return \Illuminate\Contracts\View\Factory
	 * @throws \Exception
	 * \Illuminate\Http\RedirectResponse
	 * \Illuminate\View\View
	 */
	public function bookings()
	{
		if ($this->user->reservations->isEmpty()) {
			return redirect()->route('reservations.create');
		}

		Reservation::cancelOldReservations();

		return view('reservations.index', ['reservations' => $this->user->reservations()->paginate(50)]);
	}

	/**
	 * @return \Illuminate\Contracts\View\Factory
	 * \Illuminate\Http\RedirectResponse
	 * \Illuminate\Routing\Redirector|\Illuminate\View\View
	 */
	public function orders()
	{
		if ($this->user->shoppingCarts->isEmpty()) {
			return redirect('menu');
		}

		$carts = $this->user->shoppingCarts()->orderBy('created_at', 'DESC')->paginate(50);

		$carts->transform(function($cart) {
			$cart->orders = unserialize($cart->orders);

			return $cart;
		});

		return view('cart.index', compact('carts'));
	}
}
