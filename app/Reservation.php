<?php

namespace Javan;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
	protected $fillable = [
		'date',
		'time',
		'seats',
		'active',
	];

	public function user()
	{
		return $this->belongsTo(User::class);
	}

	public function setDateAttribute($value)
	{
		$this->attributes['date'] = str_replace('/', '-', $value);
	}

	public function getTimeAttribute($value)
	{
		return (new Carbon($value))->format('h:i');
	}

	public function getDateAttribute($value)
	{
		return new Carbon($value);
	}

	public static function cancelOldReservations()
	{
		$bookings = Reservation::all();

		foreach ($bookings as $booking) {
			if (expired($booking->date)) {
				$booking->delete();
			}
		}
	}
}
