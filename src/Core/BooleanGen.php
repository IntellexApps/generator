<?php namespace Intellex\Generator\Core;

/**
 * Class BooleanGen generates a boolean value, with the ability to give more chances to any
 * of the results.
 *
 * @package Intellex\Generator\Core
 */
class BooleanGen extends WeightedItemGen {

	/**
	 * BooleanGen constructor.
	 *
	 * @param float $percentage A chance that true will be generated accepts both as percentage
	 *                          (input greater than one), or as a rational number (input is between
	 *                          0 and 1, including both zero and one.
	 *                          If 1 is supplied, the result will always be true.
	 */
	public function __construct($percentage = 0.5) {

		// Handle rational
		if ($percentage <= 1) {
			$percentage = $percentage * 100;
		}

		// Sanitize the value
		$percentage = round(min(100, max(0, $percentage)));
		parent::__construct([ true => $percentage, false => 100 - $percentage ]);
	}

	/** @inheritdoc */
	public function gen() {
		return (bool) parent::gen();
	}

}
