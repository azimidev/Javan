<?php

namespace Javan\Http\Controllers;

use Javan\Http\Requests\PhotoRequest;
use Javan\Photo;
use Javan\Post;

class PhotosController extends Controller
{
	/**
	 * PhotosController constructor.
	 *
	 * @throws \Illuminate\Auth\Access\AuthorizationException
	 */
	public function __construct()
	{
		$this->middleware(['auth', 'admin.manager']);
	}

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
	 * @param \Javan\Photo $photo
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function destroy(Photo $photo)
	{
		if ( ! auth()->user()->owns($photo->post)) {

			if (request()->ajax()) {
				return response(['message' => 'Unauthorized Action!'], 403);
			}

			flash()->error('Unauthorized Action!', 'You are not authorized to do this action');

			return back();
		}

		$photo->delete();

		flash()->success('Success', 'Your photo was deleted');

		return back();
	}
}
