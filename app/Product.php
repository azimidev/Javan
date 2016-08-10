<?php

namespace Javan;

use File;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
	protected $fillable = [
		'title',
		'description',
		'price',
		'category',
		'image_path',
	];

	/**
	 * This is how to use:
	 * $user->hasCategory('appetizer');
	 *
	 * @param $category
	 * @return bool
	 */
	public function hasCategory($category)
	{
		if (is_string($category)) {
			return $this->category == $category;
		}
		if (is_array($category)) {
			foreach ($category as $c) {
				if ($this->hasCategory($c)) {
					return TRUE;
				}
			}
		}
	}

	/**
	 * @throws \Exception
	 */
	public function delete()
	{
		parent::delete();

		File::delete([$this->image_path]);
	}
}
