<?php

namespace Javan\Http\Controllers;

use Cart;
use Illuminate\Http\Request;
use Instagram;
use Javan\AppMailer;
use Javan\Jobs\SendEmailConfirmation;
use Javan\Jobs\SendEmailToAdmin;
use Javan\Post;
use Javan\Product;
use Javan\Reservation;
use Javan\User;

class PagesController extends Controller
{
	/**
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function home()
	{
		$images = Instagram::getResultImage(12);

		return view('pages.home', compact('images'));
	}

	/**
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function about()
	{
		return view('pages.about');
	}

	/**
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
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
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function contact()
	{
		return view('pages.contact');
	}

	/**
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function information()
	{
		return view('pages.information');
	}

	/**
	 * @param null $slug
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function blog($slug = NULL)
	{
		$posts = Post::visible()->with('user', 'photos')->paginate(20);

		$post = $slug ? Post::slug($slug) : NULL;

		return view('pages.blog', compact('posts', 'post'));
	}

	/**
	 * @param \Illuminate\Http\Request $request
	 * @param \Javan\AppMailer $mailer
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function sendEmailEnquiry(Request $request, AppMailer $mailer)
	{
		$this->validate($request, [
			'name'         => 'required',
			'email'        => 'required|email',
			'user_message' => 'required',
		]);

		$mailer->sendEmail($request);

		flash()->success('Thank You!', 'Your message was sent successfully.');

		return back();
	}

	/**
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
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
			'date'     => 'required',
			'time'     => 'required',
			'seats'    => 'required|max:50',
		]);

		$user = User::create([
			'name'     => $request->input('name'),
			'email'    => $request->input('email'),
			'phone'    => $request->input('phone'),
			'password' => $request->input('password'),
		]);

		$reservation          = new Reservation($request->all());
		$reservation->user_id = $user->id;
		$reservation->save();

		$this->dispatch(new SendEmailToAdmin($reservation));
		$this->dispatch(new SendEmailConfirmation($reservation));

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
		Cart::add($product->id, $product->title, 1, number_format($product->price / 100, 2));

		return back();
	}

	/**
	 * @param $rowId
	 * @param $qty
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function removeFromCart($rowId, $qty)
	{
		$qty > 1 ? Cart::update($rowId, $qty - 1) : Cart::remove($rowId);

		return back();
	}

	/**
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function destroyCart()
	{
		Cart::destroy();

		return back();
	}
}
