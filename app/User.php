<?php

namespace Javan;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
	protected $fillable = [
		'name',
		'role',
		'email',
		'password',
		'active',
		'address',
		'city',
		'post_code',
		'phone',
	];
	protected $hidden   = [
		'password',
		'remember_token',
	];

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function reservations()
	{
		return $this->hasMany(Reservation::class);
	}

	/**
	 * @param \Javan\Post $post
	 * @return \Illuminate\Database\Eloquent\Model
	 */
	public function publish(Post $post)
	{
		return $this->posts()->save($post);
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function posts()
	{
		return $this->hasMany(Post::class);
	}

	/**
	 * @param $related
	 * @return bool
	 */
	public function owns($related)
	{
		return $this->id == $related->user_id;
	}

	/**
	 * @param $value
	 */
	public function setNameAttribute($value)
	{
		$this->attributes['name'] = ucwords($value);
	}

	/**
	 * @param $password
	 */
	public function setPasswordAttribute($password)
	{
		$this->attributes['password'] = bcrypt($password);
	}

	/**
	 * @param $query
	 * @return mixed
	 */
	public function scopeisMember($query)
	{
		return $query->where('role', 'member');
	}

	/**
	 * @param $query
	 * @return mixed
	 */
	public function scopeisManager($query)
	{
		return $query->where('role', 'manager');
	}

	/**
	 * @param $query
	 * @return mixed
	 */
	public function scopeisAdmin($query)
	{
		return $query->where('role', 'admin');
	}

	/**
	 * @param $query
	 * @return mixed
	 */
	public function scopeisActive($query)
	{
		return $query->where('active', TRUE);
	}

	/**
	 * This is how to use:
	 * $user->hasRole('manager');
	 *
	 * @param $role
	 * @return bool
	 */
	public function hasRole($role)
	{
		if (is_string($role)) {
			return $this->role == $role;
		}
		if (is_array($role)) {
			foreach ($role as $r) {
				if ($this->hasRole($r)) {
					return TRUE;
				}
			}
		}
	}

	/**
	 * @return bool
	 */
	public function isSelf()
	{
		return $this->id === auth()->user()->id;
	}
}
