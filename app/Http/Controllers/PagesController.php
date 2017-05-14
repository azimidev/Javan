<?php

namespace Javan\Http\Controllers;

use Cache;
use Cart;
use Illuminate\Http\Request;
use Instagram;
use Javan\AppMailer;
use Javan\Event;
use Javan\Jobs\SendReservationConfirmation;
use Javan\Jobs\SendReservationToAdmin;
use Javan\Post;
use Javan\Product;
use Javan\Reservation;
use Javan\User;

class PagesController extends Controller
{
	/**
	 * @return \Illuminate\View\View
	 */
	public function home()
	{
		return redirect()->route('menu');
		// $images = Instagram::getResultImage(12);
		// $events = Event::active()->latest()->limit(1)->get();
		//
		// return view('pages.home', compact('images', 'events'));
	}

	/**
	 * @return \Illuminate\View\View
	 */
	public function about()
	{
		return view('pages.about');
	}

	/**
	 * @return \Illuminate\View\View
	 */
	public function menu()
	{
		$appetizers   = Product::whereCategory('appetizer')->get();
		$main_courses = Product::whereCategory('main_course')->get();
		$extras       = Product::whereCategory('extra')->get();
		$beverages    = Product::whereCategory('beverage')->get();
		$juices       = Product::whereCategory('juice')->get();
		$desserts     = Product::whereCategory('dessert')->get();

		return view('pages.menu', compact('appetizers', 'main_courses', 'extras', 'beverages', 'juices', 'desserts'));
	}

	/**
	 * @return \Illuminate\View\View
	 */
	public function music()
	{
		$events = Event::active()->latest()->limit(1)->get();

		return view('pages.music', compact('events'));
	}

	/**
	 * @return \Illuminate\View\View
	 */
	public function contact()
	{
		return view('pages.contact');
	}

	/**
	 * @return \Illuminate\View\View
	 */
	public function information()
	{
		return view('pages.information');
	}

	/**
	 * @return \Illuminate\Http\Response
	 */
	public function feed()
	{
		if (Cache::has('rss')) {
			$posts = Cache::pull('rss');
		} else {
			$posts = Cache::remember('rss', 1440, function() {
				return Post::with('user', 'photos')->latest()->limit(10)->get();
			});
		}

		return response()->view('pages.rss', compact('posts'))
		                 ->header('Content-Type', 'application/atom+xml; charset=UTF-8');
	}

	/**
	 * @param null $slug
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function blog($slug = NULL)
	{
		$posts = Post::visible()->with('user', 'photos')->latest()->paginate(20);

		$post = $slug ? Post::slug($slug) : NULL;

		return view('pages.blog', compact('posts', 'post'));
	}

	/**
	 * @return \Illuminate\View\View
	 */
	public function createReservation()
	{
		return view('pages.reservation');
	}

	/**
	 * @param \Illuminate\Http\Request $request
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function storeReservation(Request $request)
	{
		$this->validate($request, [
			'name'     => 'required|max:255',
			'email'    => 'required|email|max:255|unique:users',
			'phone'    => 'required|numeric',
			'password' => 'required|min:6|confirmed',
			'date'     => 'required|date',
			'time'     => 'required',
			'seats'    => 'required|max:25',
		]);

		if (strtotime($request->input('date') . ' ' . $request->input('time')) < time()) {
			flash()->error('Error!', 'You cannot book the past. Try to change the date and time');

			return back()->withInput();
		}

		$user = User::create([
			'name'     => $request->input('name'),
			'email'    => $request->input('email'),
			'phone'    => $request->input('phone'),
			'password' => $request->input('password'),
		]);

		$reservation          = new Reservation($request->all());
		$reservation->user_id = $user->id;
		$reservation->save();

		$this->dispatch(new SendReservationToAdmin($reservation));
		$this->dispatch(new SendReservationConfirmation($reservation));

		auth()->login($user);
		flash()->success('Success', 'You have booked successfully and your are a member now');

		return redirect()->route('member.show');
	}

	/**
	 * @param \Javan\Product $product
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function addToCart(Product $product)
	{
		Cart::instance('menu')->add($product->id, $product->title, 1, number_format($product->price / 100, 2));

		return back();
	}

	/**
	 * @param $rowId
	 * @param $qty
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function removeFromCart($rowId, $qty)
	{
		$qty > 1 ? Cart::instance('menu')->update($rowId, $qty - 1) : Cart::instance('menu')->remove($rowId);

		return back();
	}

	/**
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function destroyCart()
	{
		Cart::instance('menu')->destroy();

		return back();
	}

	/**
	 * @param \Javan\Event $event
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function addEventToCart(Event $event)
	{
		$this->validate(request(), [
			'quantity' => 'required|numeric|between:1,' . $event->seatsRemaining(),
		]);
		Cart::instance('event')->add(
			$event->id,
			$event->name,
			request('quantity'),
			number_format($event->price / 100, 2)
		);

		return back();
	}

	/**
	 * @param $rowId
	 * @param $qty
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function removeEventFromCart($rowId, $qty)
	{
		$qty > 1 ? Cart::instance('event')->update($rowId, $qty - 1) : Cart::instance('event')->remove($rowId);

		return back();
	}

	/**
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function destroyEventCart()
	{
		Cart::instance('event')->destroy();

		return back();
	}

	/**
	 * @return array
	 */
	public function deliverable()
	{
		$this->validate(request(), ['post_code' => 'required|min:2']);

		$destination = urlencode(trim(request()->input('post_code')));

		return deliverable($destination);
	}
}
