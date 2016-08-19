<?php

namespace Javan;

use Illuminate\Database\Eloquent\Model;

class ShoppingCart extends Model
{
	protected $fillable = [
		'user_id',
		'charge_id',
		'refund_id',
		'orders',
		'total',
		'status',
		'note',
	];

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function user()
	{
		return $this->belongsTo(User::class);
	}
}
