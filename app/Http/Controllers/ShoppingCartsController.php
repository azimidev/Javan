<?php

namespace Javan\Http\Controllers;

use Cart;
use Exception;
use Illuminate\Http\Request;
use Javan\ShoppingCart;
use Stripe\Charge;
use Stripe\Stripe;

class ShoppingCartsController extends Controller
{
	/**
	 * ShoppingCartsController constructor.
	 */
	public function __construct()
	{
		$this->middleware(['auth']);
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		//
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		return view('cart.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		Stripe::setApiKey(env('STRIPE_SECRET'));
		$this->validate($request, [
			'stripeToken' => 'required',
		]);
		ShoppingCart::create([
			'user_id' => auth()->user()->id,
			'content' => Cart::content()->toJson(),
			'total'   => (int) Cart::total() * 100,
			'status'  => TRUE,
			'note'    => $request->input('note'),
		]);
		try {
			Charge::create([
				'amount'      => Cart::total() * 100,
				'currency'    => 'gbp',
				'card'        => $request->input('stripeToken'),
				'description' => 'Charge for ' . $request->input('cardholdername'),
			]);
			flash()->overlay('Payment was successfull', 'Your payment was successfull and delivery has been place');

			Cart::destroy();

			return back();
		} catch (Exception $e) {
			flash()->error('Error!', $e->getMessage());

			return back();
		}
	}

	/**
	 * Display the specified resource.
	 *
	 * @param \Javan\ShoppingCart $shoppingCart
	 * @return \Illuminate\Http\Response
	 */
	public function show(ShoppingCart $shoppingCart)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param \Javan\ShoppingCart $shoppingCart
	 * @return \Illuminate\Http\Response
	 */
	public function edit(ShoppingCart $shoppingCart)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @param \Javan\ShoppingCart $shoppingCart
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, ShoppingCart $shoppingCart)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param \Javan\ShoppingCart $shoppingCart
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(ShoppingCart $shoppingCart)
	{
		//
	}
}
