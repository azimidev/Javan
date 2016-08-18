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
	 * @throws \Exception
	 */
	public static function cancelOldReservations()
	{
		foreach (Reservation::all() as $reservation) {
			if (expired($reservation->date)) {
				$reservation->delete();
			}
		}
	}

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
}
