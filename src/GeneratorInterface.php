<?php namespace Intellex\Generator;

/**
 * Interface GeneratorInterface defines interface and required methods for all generator classes.
 *
 * @package Intellex\Generator
 */
interface GeneratorInterface {

	/**
	 * Generate a value.
	 *
	 * @return mixed The generated value.
	 */
	public function gen();

}
