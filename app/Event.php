<?php

namespace Javan;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
	protected $fillable = [
		'name',
		'description',
		'slug',
		'capacity',
		'price',
		'acrive',
		'image_path',
		'start',
		'finish',
	];

	/**
	 * The attributes that should be mutated to dates.
	 *
	 * @var array
	 */
	protected $dates = [
		'created_at',
		'updated_at',
		'start',
		'finish',
	];

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function booking()
	{
		return $this->hasMany(Booking::class);
	}

	/**
	 * @param $slug
	 * @return mixed
	 */
	public static function slug($slug)
	{
		return static::with('booking')->whereSlug($slug)->firstOrFail();
	}

	/**
	 * @param $value
	 * @return string
	 */
	public function getNameAttribute($value)
	{
		return ucwords($value);
	}
}
