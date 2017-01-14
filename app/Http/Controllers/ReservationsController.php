<?php

namespace Javan\Http\Controllers;

use Illuminate\Http\Request;
use Javan\Jobs\SendReservationConfirmation;
use Javan\Jobs\SendReservationToAdmin;
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
	 * @throws \Exception
	 */
	public function index()
	{
		Reservation::cancelOldReservations();

		$sortBy    = request()->get('sortBy');
		$direction = request()->get('direction');
		$params    = compact('sortBy', 'direction');

		if ($sortBy && $direction) {
			$reservations = Reservation::with('user')->orderBy($params['sortBy'], $params['direction'])->paginate(50);
		} else {
			$reservations = Reservation::with('user')->latest()->paginate(50);
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
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function store(Request $request)
	{
		$this->validate($request, [
			'date'  => 'required|date',
			'time'  => 'required',
			'seats' => 'required|max:25',
		]);

		if (strtotime($request->input('date') . ' ' . $request->input('time')) < time()) {
			flash()->error('Error!', 'You cannot book the past.');

			return back()->withInput();
		}

		$reservation          = new Reservation($request->all());
		$reservation->user_id = $request->user()->id;
		$reservation->save();

		$this->dispatch(new SendReservationToAdmin($reservation));
		$this->dispatch(new SendReservationConfirmation($reservation));

		flash()->success('Success', 'You have booked successfully');

		return redirect()->route('member.reservations');
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
	 * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
	 */
	public function update(Request $request, Reservation $reservations)
	{
		$this->validate($request, [
			'date'  => 'required',
			'time'  => 'required',
			'seats' => 'required|max:50',
		]);

		if (strtotime($request->input('date') . ' ' . $request->input('time')) < time()) {
			flash()->error('Error!', 'You cannot change your booking to the past date.');

			return back()->withInput();
		}

		$reservations->update($request->all());

		flash()->success('Success', 'Reservation was updated');

		return redirect()->route('member.reservations');
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
