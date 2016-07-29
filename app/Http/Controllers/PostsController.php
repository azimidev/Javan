<?php

namespace Javan\Http\Controllers;

use Javan\Http\Requests\PhotoRequest;
use Javan\Http\Requests\PostRequest;
use Javan\Photo;
use Javan\Post;

class PostsController extends Controller
{
	/**
	 * PostsController constructor.
	 *
	 * @throws \Illuminate\Auth\Access\AuthorizationException
	 */
	public function __construct()
	{
		$this->middleware(['auth', 'admin.manager'], ['except' => ['index', 'show']]);
		$this->middleware(['must.own.post'], ['only' => ['edit', 'update', 'destroy']]);
	}

	/**
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		$posts = Post::with('user', 'photos')->paginate(50);

		return view('posts.index', compact('posts'));
	}

	/**
	 * @param $slug
	 * @return mixed
	 */
	public function show($slug)
	{
		$post = Post::slug($slug);

		return view('posts.show', compact('post'));
	}

	/**
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function create()
	{
		return view('posts.create');
	}

	/**
	 * @param \Javan\Http\Requests\PostRequest $request
	 * @return \Javan\Post
	 */
	public function store(PostRequest $request)
	{
		$post          = new Post;
		$post->user_id = $request->user()->id;
		$post->slug    = str_slug($request->subject);
		$post->subject = $request->subject;
		$post->body    = $request->body;
		$post->visible = $request->visible;

		// $index = 1;
		// while (Post::whereSlug($post->slug)->exists()) {
		// 	$post->slug = str_slug($request->subject) . '-' . $index++;
		// }

		$latestSlug = Post::whereRaw("slug RLIKE '^{$post->slug}(-[0-9]*)?$'")
		                  ->orderBy('id')
		                  ->pluck('slug');

		if ( ! $latestSlug->isEmpty()) {
			$pieces = explode('-', $latestSlug);
			$number = (int) end($pieces);
			$post->slug .= '-' . ($number + 1);
		}

		$post->save();

		return redirect()->route('post.show', $post->slug);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param $post
	 * @return \Illuminate\Http\Response
	 * @internal param int $id
	 */
	public function edit(Post $post)
	{
		return view('posts.edit', compact('post'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param \Javan\Http\Requests\PostRequest $request
	 * @param \Javan\Post $post
	 * @return \Illuminate\Http\Response
	 */
	public function update(PostRequest $request, Post $post)
	{
		$post->update($request->all());
		flash()->success('Success', 'Post has been updated successfully');

		return redirect()->route('post.show', $post->slug);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param \Javan\Post $post
	 * @return \Illuminate\Http\Response
	 * @throws \Exception
	 */
	public function destroy(Post $post)
	{
		$post->delete();
		flash()->success('Success', 'The post was deleted successfully');

		return back();
	}
}


