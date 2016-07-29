<?php

namespace Javan\Http\Requests;

use Javan\Post;

class PhotoRequest extends Request
{
	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		return $this->user()->owns(Post::slug($this->slug));
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
			'photo'   => 'mimes:jpg,jpeg,png,bmp',
		];
	}
}
