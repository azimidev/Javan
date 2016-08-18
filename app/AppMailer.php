<?php
namespace Javan;

use Illuminate\Contracts\Mail\Mailer;

class AppMailer
{
	protected $mailer;
	protected $from = 'javanlondon@zoho.com';
	protected $to;
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
		$this->to   = env('ADMIN_EMAIL');
		$this->view = 'emails.contact';

		$this->deliver();
	}

	/**
	 * @param $email
	 * @param $data
	 */
	public function sendReservationConfirmationTo($email, $data)
	{
		$this->data = $data;
		$this->to   = $email;
		$this->view = 'emails.reservation-confirmation';

		$this->deliver();
	}

	/**
	 * @param $email
	 * @param $data
	 */
	public function sendReservationToAdmin($email, $data)
	{
		$this->data = $data;
		$this->to   = $email;
		$this->view = 'emails.admin-reservation-notice';

		$this->deliver();
	}

	/**
	 * @param $email
	 * @param $data
	 */
	public function sendOrderConfirmationTo($email, $data)
	{
		$this->data = $data;
		$this->to   = $email;
		$this->view = 'emails.order-confirmation';

		$this->deliver();
	}

	/**
	 * @param $email
	 * @param $data
	 */
	public function sendOrderToAdmin($email, $data)
	{
		$this->data = $data;
		$this->to   = $email;
		$this->view = 'emails.admin-order-notice';

		$this->deliver();
	}

	/**
	 * @param $output
	 */
	public function sendAttachment($output)
	{
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