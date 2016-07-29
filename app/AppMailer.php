<?php
namespace Javan;

use Illuminate\Contracts\Mail\Mailer;

class AppMailer
{
	protected $mailer;
	protected $from = 'NoReply@javan-restaurant.co.uk';
	protected $to   = 'hazz.azimi@gmail.com';
	protected $view;
	protected $data = [];

	/**
	 * Mailer constructor.
	 *
	 * @param $mailer
	 */
	public function __construct(Mailer $mailer)
	{
		$this->mailer = $mailer;
	}

	/**
	 * @param      $request
	 */
	public function sendEmail($request)
	{
		$this->data = $request->all();
		$this->from = $request->input('email');
		$this->view = 'emails.contact';

		$this->deliver();
	}

	/**
	 * Sends email
	 */
	public function deliver()
	{
		$this->mailer->send($this->view, $this->data, function($message) {
			$message->from($this->from, 'Javan Restaurant')->to($this->to)->subject('Enquiry');
		});
	}
}