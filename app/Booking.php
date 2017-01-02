<?php

namespace Javan;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
	protected $fillable = [
		'user_id',
		'event_id',
		'charge_id',
		'refund_id',
		'seats',
		'total',
		'ticket',
		'active'
	];

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function user()
	{
		return $this->belongsTo(User::class);
	}
	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function event()
	{
		return $this->belongsTo(Event::class);
	}
}
