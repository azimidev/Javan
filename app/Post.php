<?php

namespace Javan;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
	use Schedulable;

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
}
