<?php namespace Intellex\Generator\Core;

use Intellex\Generator\GeneratorInterface;

/**
 * Class HardcodedGen uses the value supplied in the constructor as a generated value, every time.
 *
 * @package Intellex\Generator\Core
 */
class HardcodedGen implements GeneratorInterface {

	/** @var mixed The value which this generator will produce. */
	private $value;

	/**
	 * BooleanGen constructor.
	 *
	 * @param mixed $value The value which this generator will produce.
	 */
	public function __construct($value) {
		$this->value = $value;
	}

	/**
	 * Output the hardcoded value.
	 *
	 * @return mixed The value supplied in the constrictor.
	 */
	public function gen() {
		return $this->value;
	}

}