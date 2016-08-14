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

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function user()
	{
		return $this->belongsTo(User::class);
	}

	/**
	 * @param $value
	 */
	public function setDateAttribute($value)
	{
		$this->attributes['date'] = str_replace('/', '-', $value);
	}

	/**
	 * @param $value
	 * @return string
	 */
	public function getTimeAttribute($value)
	{
		return (new Carbon($value))->format('h:i');
	}

	/**
	 * @param $value
	 * @return \Carbon\Carbon
	 */
	public function getDateAttribute($value)
	{
		return new Carbon($value);
	}

	/**
	 * @throws \Exception
	 */
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
