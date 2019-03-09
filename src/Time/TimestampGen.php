<?php namespace Intellex\Generator\Time;

use Intellex\Generator\Core\NumericGen;

/**
 * Class TimestampGen generates a random timestamp in a given range.
 *
 * @package Intellex\Generator\Time
 */
class TimestampGen extends NumericGen {

	/** @var string|null The format for the data function, or null to return the timestamp. */
	private $format;

	/**
	 * DateTimeGen constructor.
	 *
	 * @param int|string  $from   Starting range for random date, either as string to be parsed or
	 *                            as integer representing timestamp.
	 * @param int|string  $to     Starting range for random date, either as string to be parsed or
	 *                            as integer representing timestamp.
	 * @param string|null $format The format for the data function, or null to return the timestamp.
	 */
	public function __construct($from = '-6 months', $to = 'now', $format = null) {
		parent::__construct(static::parseTimestamp($from), static::parseTimestamp($to));
		$this->format = $format;
	}

	/**
	 * Generate a random timestamp.
	 *
	 * @return string|int The generated value.
	 */
	public function gen() {
		$time = parent::gen();

		$format = $this->getFormat();
		return $format
			? date($format, $time)
			: $time;
	}

	/**
	 * Get the format for the date() function, which will be used to generate a random time.
	 *
	 * @return string|null The format for the data function, or null to return the timestamp.
	 */
	protected function getFormat() {
		return $this->format;
	}

	/**
	 * Make sure that the supplied time is represented as timestamp.
	 *
	 * @param string|int $time The original input.
	 *
	 * @return int The timestamp, as seconds from the start of the UNIX epoch.
	 */
	protected static function parseTimestamp($time) {

		// No parsing needed
		if (is_numeric($time)) {
			return (int) $time;
		}

		return (int) strtotime($time);
	}

}
