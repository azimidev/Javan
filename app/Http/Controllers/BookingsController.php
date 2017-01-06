<?php

namespace Javan\Http\Controllers;

use Cart;
use Illuminate\Http\Request;
use Javan\Billing\BillingInterface;
use Javan\Booking;
use Javan\Jobs\SendBookingConfirmation;
use Javan\Jobs\SendBookingToAdmin;

class BookingsController extends Controller
{
	protected $billing;

	/**
	 * ShoppingCartsController constructor.
	 *
	 * @param \Javan\Billing\BillingInterface $billing
	 */
	public function __construct(BillingInterface $billing)
	{
		$this->middleware('auth');
		$this->middleware('admin.manager', ['except' => ['create', 'store', 'show']]);
		$this->billing = $billing;
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
		return view('bookings.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		// TODO: check if there is any seats available or not fully booked
		// TODO: check if cart is not empty

		$charge  = $this->billing->charge([
			'total' => Cart::instance('event')->subtotal() * 100,
			'email' => auth()->user()->email,
			'token' => $request->input('stripe-token'),
		]);
		$booking = Booking::create([
			'user_id'   => auth()->user()->id,
			'event_id'  => Cart::instance('event')->content()->first()->id,
			'charge_id' => $charge->id,
			'seats'     => Cart::instance('event')->content()->first()->qty,
			'total'     => Cart::instance('event')->subtotal() * 100,
			'ticket'    => random_int(1000, 9999), // strtoupper(str_random(5))
			'active'    => TRUE,
		]);
		$this->dispatch(new SendBookingToAdmin($booking));
		// $this->dispatch(new SendBookingConfirmation($booking));
		Cart::instance('event')->destroy();
		flash()->overlay('Payment was successfull', "Ticket has been purchased. Please check your email for more info. <br> Your ticket number is <strong>{$booking->ticket}</strong>");

		return redirect()->route('member.bookings');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @param  int $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{
		//
	}
}
