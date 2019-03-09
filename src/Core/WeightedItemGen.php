<?php namespace Intellex\Generator\Core;

use Intellex\Generator\GeneratorInterface;

/**
 * Class WeightedItemGen picks a random item from the pool, with the ability to influence the
 * change of picking for each item.
 *
 * @package Intellex\Generator\Core
 */
class WeightedItemGen implements GeneratorInterface {

	/** @var array List of all possible values, where key will be return as the generated value and the value is the weight of this item. The grater the weight, the more likely this item is to be chosen. */
	private $pool = [];

	/**
	 * BooleanGen constructor.
	 *
	 * @param mixed $pool List of all possible values, where key will be return as the generated
	 *                    value and the value is the weight of this item. The grater the weight,
	 *                    the more likely this item is to be chosen.
	 */
	public function __construct($pool) {
		foreach ($pool as $value => $weight) {
			$this->pool = array_merge($this->pool, array_fill(0, $weight, $value));
		}

		// There must be at least one item in array
		if (empty($this->pool)) {
			throw new \InvalidArgumentException("Empty array supplied.");
		}
	}

	/**
	 * Pick an item.
	 *
	 * @return mixed The picked value.
	 */
	public function gen() {
		return $this->pool[rand(0, sizeof($this->pool) - 1)];
	}

}