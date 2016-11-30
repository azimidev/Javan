<?php

namespace Javan;

use DateInterval;
use DateTime;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
	protected $fillable = ['subject', 'slug', 'body', 'visible'];

	/**
	 * @param $slug
	 * @return mixed
	 */
	public static function slug($slug)
	{
		return static::with('user', 'photos')->whereSlug($slug)->firstOrFail();
	}

	/**
	 * @param $value
	 * @return string
	 */
	public function getSubjectAttribute($value)
	{
		return ucwords($value);
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function user()
	{
		return $this->belongsTo(User::class);
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function photos()
	{
		return $this->hasMany(Photo::class);
	}

	/**
	 * @param $query
	 * @return mixed
	 */
	public function scopeVisible($query)
	{
		return $query->where('visible', TRUE);
	}

	/**
	 * Format: Please note that you always have to add P in the beginning
	 * Y    years
	 * M    months
	 * D    days
	 * W    weeks. These get converted into days, so can not be combined with D.
	 * H    hours
	 * M    minutes
	 * S    seconds
	 *
	 * @return bool
	 */
	public function uptodate()
	{
		$interval = new DateInterval('P1W'); // 1 Week
		$now      = new DateTime();

		return (new DateTime($this->updated_at))->add($interval) > $now && ( ! $this->recent());
	}

	/**
	 * Format: Please note that you always have to add P in the beginning
	 * Y    years
	 * M    months
	 * D    days
	 * W    weeks. These get converted into days, so can not be combined with D.
	 * H    hours
	 * M    minutes
	 * S    seconds
	 *
	 * @return bool
	 */
	public function recent()
	{
		$interval = new DateInterval('P1W'); // 1 Week
		$now      = new DateTime();

		return (new DateTime($this->created_at))->add($interval) > $now;
	}
}
