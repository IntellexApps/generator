<?php namespace Intellex\Generator\Core;

use Intellex\Generator\GeneratorInterface;

/**
 * Class NumericGen generates a random number in a specified range.
 *
 * @package Intellex\Generator\Core
 */
class NumericGen implements GeneratorInterface {

	/** @var int The lower boundary, inclusive. */
	private $min;

	/** @var int The upper boundary, inclusive. */
	private $max;

	/**
	 * NumericGen constructor.
	 *
	 * @param int $min The lower boundary, inclusive.
	 * @param int $max The upper boundary, inclusive.
	 */
	public function __construct($min = 1, $max = 100) {
		$this->min = $min;
		$this->max = $max;
	}

	/**
	 * Generate a random number.
	 *
	 * @return int A random number between numbers defined in the constructor, both inclusive).
	 */
	public function gen() {
		return rand($this->min, $this->max);
	}

}
