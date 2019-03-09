<?php namespace Intellex\Generator\Core;

/**
 * Class ItemGen picks an item from the pool, where every item has the same change of being
 * picked.
 *
 * @package Intellex\Generator\Core
 */
class ItemGen extends WeightedItemGen {

	/**
	 * BooleanGen constructor.
	 *
	 * @param mixed[] Associative array of possible values.
	 */
	public function __construct($array) {
		$values = [];
		foreach ($array as $value) {
			$values[$value] = 1;
		}
		parent::__construct($values);
	}

}