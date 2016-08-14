<?php

namespace Javan;

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
	 * @return bool
	 */
	public function uptodate()
	{
		$interval = (new DateTime('+1 week'))->getTimestamp() - time();

		return (strtotime($this->updated_at) + $interval > time()) && ( ! $this->recent());
	}

	/**
	 * @return bool
	 */
	public function recent()
	{
		$interval = (new DateTime('+1 week'))->getTimestamp() - time();

		return strtotime($this->created_at) + $interval > time();
	}
}
