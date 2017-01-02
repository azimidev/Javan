<?php

namespace Javan\Http\Controllers;

use File;
use Illuminate\Http\Request;
use Javan\Event;

class EventsController extends Controller
{
	/**
	 * ShoppingCartsController constructor.
	 */
	public function __construct()
	{
		$this->middleware('auth');
		$this->middleware('admin.manager', ['except' => ['create', 'store', 'show']]);
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		$events = Event::with('booking')->latest()->paginate(50);

		return view('events.index', compact('events'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		return view('events.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		$this->validate($request, [
			'name'        => 'required|min:3|max:255',
			'description' => 'required',
			'capacity'    => 'required|numeric',
			'price'       => 'required|numeric',
			'active'      => 'required',
			'start'       => 'date_format:Y-m-d H:i:s|required',
			'finish'      => 'date_format:Y-m-d H:i:s|required',
		]);

		$post              = new Event;
		$post->name        = $request->name;
		$post->description = $request->description;
		$post->slug        = str_slug($request->name);
		$post->capacity    = $request->capacity;
		$post->price       = $request->price;
		$post->active      = $request->active;
		$post->start       = $request->start;
		$post->finish      = $request->finish;

		$latestSlug = Event::whereRaw("slug RLIKE '^{$post->slug}(-[0-9]*)?$'")->orderBy('id')->pluck('slug');

		if ( ! $latestSlug->isEmpty()) {
			$pieces = explode('-', $latestSlug);
			$number = (int) end($pieces);
			$post->slug .= '-' . ($number + 1);
		}

		$post->save();

		return redirect()->route('events.show', $post->slug);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param $slug
	 * @return \Illuminate\Http\Response
	 */
	public function show($slug)
	{
		$event = Event::slug($slug);

		return view('events.show', compact('event'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param \Javan\Event $events
	 * @return \Illuminate\Http\Response
	 */
	public function edit(Event $events)
	{
		return view('events.edit', compact('events'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @param \Javan\Event $events
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, Event $events)
	{
		$events->update($request->all());
		flash()->success('Success', 'Event has been updated');

		return redirect()->route('events.show', $events->slug);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param \Javan\Event $events
	 * @return \Illuminate\Http\Response
	 * @throws \Exception
	 */
	public function destroy(Event $events)
	{
		$events->delete();
		$this->deletePhoto($events);
		flash()->success('Success', 'Event has been removed');

		return back();
	}

	/**
	 * @param \Javan\Event $event
	 * @param \Illuminate\Http\Request $request
	 * @return \Symfony\Component\HttpFoundation\File\File
	 * @throws \Symfony\Component\HttpFoundation\File\Exception\FileException
	 */
	public function addPhoto(Event $event, Request $request)
	{
		$this->validate($request, [
			'photo' => 'mimes:jpg,jpeg,png,bmp',
		]);

		$file = $request->file('photo');
		$name = time() . '-' . $file->getClientOriginalName();
		$event->update(['image_path' => 'images/events/' . $name]);

		return $file->move('images/events', $name);
	}

	/**
	 * @param \Javan\Event $event
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function deletePhoto(Event $event)
	{
		File::delete([$event->image_path]);
		$event->update(['image_path' => NULL]);
		flash()->success('Success', 'Image has been deleted');

		return back();
	}
}
