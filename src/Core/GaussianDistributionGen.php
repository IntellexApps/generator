<?php namespace Intellex\Generator\Core;

use Intellex\Generator\GeneratorInterface;

/**
 * Class GaussianDistributionGen uses a normal distribution to pick a random value in a range.
 *
 * @package Intellex\Generator\Core
 */
class GaussianDistributionGen implements GeneratorInterface {

	/** @var int The mean value. */
	protected $mean;

	/** @var int The standard deviation. */
	protected $deviation;

	/** @var int|null Minimal resulting value. */
	protected $min;

	/** @var int|null Maximum resulting value. */
	protected $max;

	/**
	 * IntegerGen constructor.
	 *
	 * @param int      $mean      The mean value.
	 * @param int      $deviation The standard deviation.
	 * @param int|null $min       Minimal resulting value, or null for no minimal limit.
	 * @param int|null $max       Maximum resulting value, or null for no minimal limit.
	 *
	 * @throws \InvalidArgumentException If supplied minimum is not less then supplied maximum.
	 */
	public function __construct($mean, $deviation, $min = null, $max = null) {
		$this->mean = $mean;
		$this->deviation = $deviation;

		// Set range
		$this->min = $min;
		$this->max = $max;

		// Check range
		if ($this->min !== null && $this->max !== null && $this->min >= $this->max) {
			throw new \InvalidArgumentException("Supplied minimum ({$this->min}) must be less then supplied maximum ({$this->max}).");
		}
	}

	/**
	 * Define maximum number of attempts at getting value between min and max.
	 *
	 * @return int The maximum number of attempts.
	 */
	protected function getMaxAttempts() {
		return 10;
	}

	/**
	 * Pick a random value.
	 *
	 * @return int A randomly generated number.
	 */
	public function gen() {
		$value = null;
		$attempts = 3;
		while (++$attempts) {

			// On max attempts return mean value
			if ($attempts >= $this->getMaxAttempts()) {
				return $this->mean;
			}

			// Get value and check for range
			$value = $this->gauss();
			if (($this->min === null || $value >= $this->min) && ($this->max === null || $value <= $this->max)) {
				break;
			}
		}

		return $value;
	}

	/**
	 * Get a random number using standard Gauss deviation.
	 *
	 * @return int A randomly generated number.
	 */
	private function gauss() {
		$rand1 = (float) mt_rand() / (float) mt_getrandmax();
		$rand2 = (float) mt_rand() / (float) mt_getrandmax();
		$gaussianNumber = sqrt(-2 * log($rand1)) * cos(2 * M_PI * $rand2);
		$randomNumber = ($gaussianNumber * $this->deviation) + $this->mean;

		return round($randomNumber);
	}
}