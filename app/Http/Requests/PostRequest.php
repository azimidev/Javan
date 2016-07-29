<?php

namespace Javan\Http\Requests;

class PostRequest extends Request
{
	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		return TRUE;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
			'subject' => 'required|min:3|max:255',
			'body'    => 'required',
		];
	}
}
