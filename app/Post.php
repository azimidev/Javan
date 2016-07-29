<?php

namespace Javan;

use DateTime;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
	protected $fillable = ['subject', 'slug', 'body', 'visible'];

	public static function slug($slug)
	{
		return static::with('user', 'photos')->whereSlug($slug)->firstOrFail();
	}

	public function getSubjectAttribute($value)
	{
		return ucwords($value);
	}

	public function user()
	{
		return $this->belongsTo(User::class);
	}

	public function photos()
	{
		return $this->hasMany(Photo::class);
	}

	public function scopeVisible($query)
	{
		return $query->where('visible', TRUE);
	}

	public function uptodate()
	{
		$interval = (new DateTime('+1 week'))->getTimestamp() - time();

		return (strtotime($this->updated_at) + $interval > time()) && ( ! $this->recent());
	}

	public function recent()
	{
		$interval = (new DateTime('+1 week'))->getTimestamp() - time();

		return strtotime($this->created_at) + $interval > time();
	}
}
