<?php namespace Intellex\Generator\Text;

/**
 * Class SentenceGenerator generates a dummy sentence.
 *
 * @package Intellex\Generator
 */
class SentenceGen extends WordGen {

	/** @var int Minimum number of words. */
	private $min;

	/**@var int Maximum number of words. */
	private $max;

	/** @var bool Set dot at end of each sentence. */
	private $dot;

	/** @var bool Place commas on random places in sentence. */
	private $comma;

	/**
	 * SentenceGen constructor.
	 *
	 * @param int  $min   Minimum number of words
	 * @param int  $max   Maximum number of words
	 * @param bool $dot   Set dot at end of each sentence
	 * @param bool $comma Place commas on random places in sentence.
	 */
	public function __construct($min = 5, $max = 25, $dot = true, $comma = true) {
		parent::__construct();
		$this->dot = $dot;
		$this->comma = $comma;
		$this->min = $min;
		$this->max = $max;
	}

	/**
	 * Generate a single random sentence.
	 *
	 * @return string The generated sentence.
	 */
	public function gen() {
		$len = rand($this->min, $this->max);

		// Used to make sure we have only one comma per sentence.
		$hasComma = false;

		// Start building
		$sentence = '';
		for ($i = 0; $i < $len; $i++) {

			// Separate word
			$glue = '';
			if (strlen($sentence)) {

				// Optional comma
				$glue = ' ';
				if ($this->comma && !$hasComma && rand(6, 11) == $i) {
					$hasComma = true;
					$glue = ', ';
				}
			}

			// Append the word
			$word = parent::gen();
			$sentence .= $glue . $word;
		}

		return ucfirst($sentence) . ($this->dot ? '.' : null);
	}

}
