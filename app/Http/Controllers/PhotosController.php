<?php

namespace Javan\Http\Controllers;

use Javan\Http\Requests\PhotoRequest;
use Javan\Photo;
use Javan\Post;

class PhotosController extends Controller
{
	/**
	 * @param $slug
	 * @param \Javan\Http\Requests\PhotoRequest $request
	 */
	public function store($slug, PhotoRequest $request)
	{
		$post = Post::slug($slug);

		$photo = Photo::fromFile($request->file('photo'))->upload();

		return $post->photos()->save($photo);
	}

	/**
	 * @param $id
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function destroy($id)
	{
		Photo::findOrFail($id)->delete();

		return back();
	}
}
