<?php namespace Intellex\Generator;

/**
 * Class Util is a utility class used by the generators.
 *
 * @package Intellex\Generator
 */
class Util {

	/**
	 * Check in an action should be executed, based on the chance to do so.
	 *
	 * @param float $value The probability of true, as a value between 0 and 1.
	 *
	 * @return bool True to execute, false to skip.
	 */
	public static function should($value) {
		if (!$value) {
			return false;
		}

		$rand = mt_rand(0, 1000000) / 1000000;
		return $rand < $value;
	}

}