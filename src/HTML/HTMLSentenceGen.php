<?php namespace Intellex\Generator\HTML;

use Intellex\Generator\Text\WordGen;
use Intellex\Generator\Util;

/**
 * Class HTMLSentenceGen generates a random sentences with random HTML tags, such as b,
 * strong, em, etc...
 *
 * @package Intellex\Generator\HTML
 */
class HTMLSentenceGen extends WordGen {

	/** @var int Minimum number of words. */
	private $min;

	/**@var int Maximum number of words. */
	private $max;

	/** @var bool Set dot at end of the sentence. */
	private $dot;

	/** @var bool Set random commas on random places in a sentence. */
	private $comma;

	/** @var float Determines the chance a word will be a dummy HTMl anchor tag, as a value between 0 and 1. */
	private $linkChance;

	/** @var float Determines the chance a word will be decorated, as a value between 0 and 1. */
	private $decorateChance;

	/** @var array Determines type of decoration tags (ie. b, strong, em, etc...). */
	private $decorations;

	/** @var string The name of CSS class given to all generated HTML tags. */
	protected $htmlClass;

	/**
	 * Constructor for SentenceGenerator.
	 * SentenceGen constructor.
	 *
	 * @param int    $min            Minimum number of words in sentence.
	 * @param int    $max            Maximum number of words in sentence
	 * @param bool   $dot            Set dot at end of the sentence.
	 * @param bool   $comma          Set random commas on random places in a sentence.
	 * @param float  $linkChance     Determines the chance a word will be a dummy HTMl anchor tag,
	 *                               as a value between 0 and 1.
	 * @param float  $decorateChance Determines the chance a word will be decorated, as a value
	 *                               between 0 and 1.
	 * @param array  $decorations    Determines type of decoration tags (ie. b, strong, em,
	 *                               etc...).
	 * @param string $htmlClass      The name of CSS class given to all generated HTML tags.
	 */
	public function __construct($min = 5, $max = 25, $dot = true, $comma = true, $linkChance = 0.01, $decorateChance = 0.1, $decorations = [ 'b', 'strong', 'i', 'em', 'u', 'strike' ], $htmlClass = 'html-generator') {
		parent::__construct();
		$this->dot = $dot;
		$this->comma = $comma;
		$this->min = $min;
		$this->max = $max;
		$this->linkChance = $linkChance;
		$this->decorateChance = $decorateChance;
		$this->decorations = $decorations;
		$this->htmlClass = $htmlClass;

	}

	/**
	 * Generate a random HTML sentence.
	 *
	 * @return string An HTML valid sentence.
	 */
	public function gen() {
		$len = rand($this->min, $this->max);

		// Used to make sure we have only one comma per sentence.
		$hasComma = false;

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

			// Get word
			$word = parent::gen();

			// Link
			if (Util::should($this->linkChance)) {
				$word = '<a class="' . $this->htmlClass . '" href="https://github.com/IntellexApps/generator" target="_blank">' . $word . '</a>';
			}

			$sentence .= $glue . $word;
		}

		// Decorate
		if (Util::should($this->decorateChance)) {
			$tag = $this->decorations[rand(0, sizeof($this->decorations) - 1)];
			$sentence = $this->tag($tag, $sentence);
		}

		return ucfirst($sentence) . ($this->dot ? '.' : null);
	}

	/**
	 * Create an HTML tag.
	 *
	 * @param string $tag     The tag to create.
	 * @param string $content The content inside the tag.
	 *
	 * @return string The content wrapped in the specified tag.
	 */
	public function tag($tag, $content) {

		// Class
		$class = null;
		if ($this->htmlClass) {
			$class = ' class="' . $this->htmlClass . '"';
		}

		return "<{$tag}{$class}>{$content}</{$tag}>";
	}

}