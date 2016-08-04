<?php

namespace Javan\Jobs;

use Javan\Jobs\Job;
use Javan\AppMailer;
use Illuminate\Http\Request;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendEmailConfirmation extends Job implements ShouldQueue
{
    use InteractsWithQueue, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

	/**
	 * Execute the job.
	 *
	 * @param \Illuminate\Http\Request $request
	 * @param \Javan\AppMailer $mailer
	 */
    public function handle(Request $request, AppMailer $mailer)
    {
	    $mailer->sendEmailConfirmation($request);
    }
}
