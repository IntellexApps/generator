<?php namespace Intellex\Generator\Time;

/**
 * Class DateGen generates a random date in YYYY-MM-DD format.
 *
 * @package Intellex\Generator\Time
 */
class DateGen extends TimestampGen {

	/**
	 * DateGen constructor.
	 *
	 * @param int|string $from    Starting range for random date, either as string to be parsed or
	 *                            as integer representing timestamp.
	 * @param int|string $to      Starting range for random date, either as string to be parsed or
	 *                            as integer representing timestamp.
	 */
	public function __construct($from = '-6 months', $to = 'now') {
		parent::__construct($from, $to, 'Y-m-d');
	}

}
