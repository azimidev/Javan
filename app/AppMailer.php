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
		$this->to   = env('ADMIN_EMAIL');
		$this->view = 'emails.contact';

		$this->deliver();
	}

	/**
	 * @param $email
	 * @param $data
	 */
	public function sendEmailConfirmationTo($email, $data)
	{
		$this->data = $data;
		$this->to   = $email;
		$this->view = 'emails.confirmation';

		$this->deliver();
	}

	/**
	 * @param $email
	 * @param $data
	 */
	public function sendEmailTo($email, $data)
	{
		$this->data = $data;
		$this->to   = $email;
		$this->view = 'emails.reservation';

		$this->deliver();
	}

	/**
	 * @param $output
	 */
	public function sendAttachment($output)
	{
		$this->from = 'NoReply@javan-restaurant.co.uk';
		$this->to   = env('ADMIN_EMAIL');
		$this->data = [];
		$this->view = 'emails.empty';
		$this->deliver($output);
	}

	/**
	 * Sends email
	 *
	 * @param null $file
	 */
	public function deliver($file = NULL)
	{
		$this->mailer->send($this->view, $this->data, function($message) use ($file) {
			$message->from($this->from, 'Javan Restaurant')->to($this->to)->subject('Enquiry');
			if ($file) {
				$message->attachData($file, 'attachment.pdf');
			}
		});
	}
}