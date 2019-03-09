<?php namespace Intellex\Generator\Time;

/**
 * Class DateTimeGen generates a random date in YYYY-MM-DD hh:mm:ss format.
 *
 * @package Intellex\Generator\Time
 */
class DateTimeGen extends TimestampGen {

	/**
	 * DateTimeGen constructor.
	 *
	 * @param int|string $from    Starting range for random date, either as string to be parsed or
	 *                            as integer representing timestamp.
	 * @param int|string $to      Starting range for random date, either as string to be parsed or
	 *                            as integer representing timestamp.
	 */
	public function __construct($from = '-6 months', $to = 'now') {
		parent::__construct($from, $to, 'Y-m-d h:i:s');
	}

}
