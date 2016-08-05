<?php

namespace Javan\Http\Controllers;

use Illuminate\Http\Request;
use Instagram;
use Javan\AppMailer;
use Javan\Jobs\SendEmailConfirmation;
use Javan\Jobs\SendEmailToAdmin;
use Javan\Post;
use Javan\Reservation;
use Javan\User;

class PagesController extends Controller
{
	public function home()
	{
		$images = Instagram::getResultImage(12);

		return view('pages.home', compact('images'));
	}

	public function about()
	{
		return view('pages.about');
	}

	public function menu()
	{
		return view('pages.menu');
	}

	public function contact()
	{
		return view('pages.contact');
	}

	public function information()
	{
		return view('pages.information');
	}

	public function blog($slug = NULL)
	{
		$posts = Post::visible()->with('user', 'photos')->paginate(20);

		$post = $slug ? Post::slug($slug) : NULL;

		return view('pages.blog', compact('posts', 'post'));
	}

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

	public function createReservation()
	{
		return view('pages.reservation');
	}

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
}
