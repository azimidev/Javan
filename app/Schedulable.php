<?php

namespace Javan;

use DateInterval;
use DateTime;

trait Schedulable
{
	/**
	 * Format: Please note that you always have to add P in the beginning
	 * Y    years
	 * M    months
	 * D    days
	 * W    weeks. These get converted into days, so can not be combined with D.
	 * H    hours
	 * M    minutes
	 * S    seconds
	 *
	 * @return bool
	 */
	public function uptodate()
	{
		$interval = new DateInterval('P1W'); // 1 Week
		$now      = new DateTime();

		return (new DateTime($this->updated_at))->add($interval) > $now && ( ! $this->recent());
	}

	/**
	 * Format: Please note that you always have to add P in the beginning
	 * Y    years
	 * M    months
	 * D    days
	 * W    weeks. These get converted into days, so can not be combined with D.
	 * H    hours
	 * M    minutes
	 * S    seconds
	 *
	 * @return bool
	 */
	public function recent()
	{
		$interval = new DateInterval('P1W'); // 1 Week
		$now      = new DateTime();

		return (new DateTime($this->created_at))->add($interval) > $now;
	}
}