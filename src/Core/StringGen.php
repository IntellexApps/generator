<?php namespace Intellex\Generator\Core;

/**
 * Class StringGen generates a random string.
 *
 * @package Intellex\Generator\Core
 */
class StringGen extends ItemGen {

	/** @var string All uppercase letters from the english alphabet. */
	const UPPERCASE = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';

	/** @var string All lowercase letters from the english alphabet. */
	const LOWERCASE = 'abcdefghijklmnopqrstuvwxyz';

	/** @var string Both uppercase and lowercase letters from the english alphabet. */
	const LETTERS = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';

	/** @var string All 10 decimal digits. */
	const DIGITS = '0123456789';

	/** @var string Uppercase hexadecimal digits. */
	const HEXADECIMAL = '0123456789ABCDEF';

	/** @var string All alphanumerical characters, both uppercase and lowercase letter included. */
	const ALPHANUMERIC = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';

	/** @var string All alphanumerical characters plus most of the symbols on the keyboard. */
	const CRYPTO = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789~!@#$%^&*()_+-={}[]|:;,.<>?/';

	/** @var int $min Minimum length for random string. */
	private $min;

	/** @var int $max Maximum length for random string. */
	private $max;

	/** @var string Mandatory prefix to prepend to the string, not calculated in the length. */
	private $prefix;

	/** @var string Mandatory suffix to append to the string, not calculated in the length. */
	private $suffix;

	/**
	 * RandomStringGen constructor.
	 *
	 * @param int    $min           Minimum length for random string.
	 * @param int    $max           Maximum length for random string.
	 * @param string $characterPool The pool of characters to use.
	 * @param string $prefix        Mandatory prefix to prepend to the string, not calculated in
	 *                              the length.
	 * @param string $suffix        Mandatory suffix to append to the string, not calculated in the
	 *                              length.
	 */
	public function __construct($min, $max, $characterPool, $prefix = null, $suffix = null) {
		$this->min = $min;
		$this->max = $max;
		$this->prefix = $prefix;
		$this->suffix = $suffix;

		parent::__construct(str_split($characterPool));
	}

	/**
	 * Generate a random string.
	 *
	 * @return string The generated string.
	 */
	public function gen() {
		$randomString = '';

		// Generate a random string, one character at a time
		$length = rand($this->min, $this->max);
		while ($length--) {
			$randomString .= parent::gen();
		}

		return $this->prefix . $randomString . $this->suffix;

	}

}
