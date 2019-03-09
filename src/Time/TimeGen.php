<?php namespace Intellex\Generator\Time;

use Intellex\Generator\Core\NumericGen;
use Intellex\Generator\GeneratorInterface;

/**
 * Class TimeGen generates a time in 24h format.
 *
 * @package Intellex\Generator\Time
 */
class TimeGen implements GeneratorInterface {

	/** @var bool Include seconds in the generated time, false for only hours and minutes. */
	private $includeSeconds;

	/** @var string The separator to use between hours, minutes and seconds. */
	private $separator;

	/**
	 * TimeGen constructor.
	 *
	 * @param bool   $includeSeconds Include seconds in the generated time, false for only hours
	 *                               and minutes.
	 * @param string $separator      The separator to use between hours, minutes and seconds.
	 */
	public function __construct($includeSeconds = true, $separator = ':') {
		$this->includeSeconds = $includeSeconds;
		$this->separator = $separator;
	}

	/**
	 * Generate a random time.
	 *
	 * @return string The generated time.
	 */
	public function gen() {

		// Hours and minutes
		$time = [
			(new NumericGen(0, 23))->gen(),
			(new NumericGen(0, 59))->gen()
		];

		// Include seconds
		if ($this->includeSeconds) {
			$time[] = (new NumericGen(0, 59))->gen();
		}

		// Always leading zero
		foreach ($time as $i => $value) {
			if ($value < 10) {
				$time[$i] = "0{$value}";
			}
		}

		return implode($this->separator, $time);
	}

}
