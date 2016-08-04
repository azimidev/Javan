<?php

namespace Javan\Http\Controllers;

use Illuminate\Http\Request;
use Javan\AppMailer;
use Javan\Jobs\SendEmailConfirmation;
use Javan\Jobs\SendEmailToAdmin;
use Javan\Reservation;

class ReservationsController extends Controller
{
	/**
	 * Create a new controller instance.
	 */
	public function __construct()
	{
		$this->middleware('auth');
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		$sortBy    = request()->get('sortBy');
		$direction = request()->get('direction');
		$params    = compact('sortBy', 'direction');

		if ($sortBy && $direction) {
			$reservations = Reservation::with('user')->orderBy($params['sortBy'], $params['direction'])->paginate(50);
		} else {
			$reservations = Reservation::with('user')->paginate(50);
		}

		return view('reservations.index', compact('reservations'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		return view('reservations.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @param \Javan\AppMailer $mailer
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request, AppMailer $mailer)
	{
		$this->validate($request, [
			'date'  => 'required',
			'time'  => 'required',
			'seats' => 'required|max:25',
		]);

		$reservation          = new Reservation($request->all());
		$reservation->user_id = $request->user()->id;
		$reservation->save();

		$this->dispatch(new SendEmailConfirmation);
		$this->dispatch(new SendEmailToAdmin($reservation));
		// TODO Job 3: Make PDF and attach it
		// $data = $reservation->load('user')->toArray();
		// $pdf  = PDF::loadView('emails.reservation', $data);
		// $mailer->sendAttachment($pdf->output());

		flash()->success('Success', 'You have booked successfully');

		return redirect()->route('member.bookings');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param $reservations
	 * @return \Illuminate\Http\Response
	 * @internal param int $id
	 */
	public function show($reservations)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param int|\Javan\Reservation $reservations
	 * @return \Illuminate\Http\Response
	 */
	public function edit(Reservation $reservations)
	{
		return view('reservations.edit', compact('reservations'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @param int|\Javan\Reservation $reservations
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, Reservation $reservations)
	{
		$this->validate($request, [
			'date'  => 'required',
			'time'  => 'required',
			'seats' => 'required|max:50',
		]);

		$reservations->update($request->all());

		flash()->success('Success', 'Reservation was updated');

		return redirect()->route('member.bookings');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param \Javan\Reservation $reservations
	 * @return \Illuminate\Http\Response
	 * @throws \Exception
	 * @internal param int $id
	 */
	public function destroy(Reservation $reservations)
	{
		$reservations->delete();

		flash()->success('Success', 'Reservation was canceled and deleted');

		return back();
	}
}
