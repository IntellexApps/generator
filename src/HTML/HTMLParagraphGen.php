<?php namespace Intellex\Generator\HTML;

use Intellex\Generator\Plus\PixabayImageURLGen;
use Intellex\Generator\Util;

/**
 * Class HTMLParagraphGen generates a valid HTML paragraph.
 *
 * @package Intellex\Generator\HTML
 */
class HTMLParagraphGen extends HTMLSentenceGen {

	/** @var int Minimum number of sentences in paragraph. */
	private $min;

	/** @var int Maximum number of sentences in paragraph. */
	private $max;

	/** @var float Chance of generating <br /> tag in paragraph, as a value between 0 and 1. */
	private $brChance;

	/** @var float Chance of generating image in paragraph, as a value between 0 and 1. */
	private $imageChance;

	/** @var float Chance of generating <ul> tag in paragraph, as a value between 0 and 1. */
	private $ulChance;

	/** @var float Chance of generating <ol> tag in paragraph, as a value between 0 and 1. */
	private $olChance;

	/** @var string API Key for Pixabay, or null to skip images. */
	protected $pixabayKey;

	/**
	 * HTMLParagraphGen constructor.
	 *
	 * @param int   $min         Minimum number of sentences in paragraph.
	 * @param int   $max         Maximum number of sentences in paragraph.
	 * @param float $brChance    Chance of generating <br /> tag in paragraph, as a value between 0
	 *                           and 1.
	 * @param float $imageChance Chance of generating image in paragraph, as a value between 0 and
	 *                           1.
	 * @param float $ulChance    Chance of generating <ul> tag in paragraph, as a value between 0
	 *                           and 1.
	 * @param float $olChance    Chance of generating <ol> tag in paragraph, as a value between 0
	 *                           and 1.
	 */
	public function __construct($min = 5, $max = 12, $brChance = 0.1, $imageChance = 0.1, $ulChance = 0.09, $olChance = 0.09) {
		parent::__construct();
		$this->min = $min;
		$this->max = $max;
		$this->brChance = $brChance;
		$this->imageChance = $imageChance;
		$this->ulChance = $ulChance;
		$this->olChance = $olChance;
	}

	/**
	 * Set the key to use for Pixabay API.
	 *
	 * @param string $key API Key for Pixabay, or null to skip images.
	 *
	 * @return HTMLParagraphGen Itself, for chaining.
	 */
	public function setPixabayKey($key) {
		$this->pixabayKey = $key;
		return $this;
	}

	/**
	 * Generate a random HTML paragraph.
	 *
	 * @return string The valid HTML.
	 */
	public function gen() {
		$len = rand($this->min, $this->max);

		// Image
		if ($this->pixabayKey !== null && Util::should($this->imageChance)) {
			return $this->generateImage();
		}

		// Ordered list
		if (Util::should($this->olChance)) {
			return $this->generateList('ol');
		}

		// Unordered list
		if (Util::should($this->ulChance)) {
			return $this->generateList('ul');
		}

		// Sentences
		$paragraph = '';
		for ($i = 0; $i < $len; $i++) {

			// Separate sentences either by space or a new line
			$glue = '';
			if (strlen($paragraph)) {

				// Optional BR over simple space
				$glue = Util::should($this->brChance)
					? '<br />'
					: ' ';
			}

			$paragraph .= $glue . parent::gen();
		}

		return parent::tag('p', $paragraph);
	}

	/**
	 * Generate an HTML list.
	 *
	 * @param string $tag The HTML tag to use, either 'ol' or 'ul'.
	 *
	 * @return string The HTML representation of a desired list.
	 */
	public function generateList($tag) {
		$len = rand($this->min, $this->max);

		$list = [];
		for ($i = 0; $i < $len; $i++) {
			$list[] = parent::tag('li', parent::gen());
		}

		return parent::tag($tag, implode("\n", $list));
	}

	/**
	 * Generate an HTML image.
	 *
	 * @return string|null The HTML img tag, with src attribute from the Pixabay API.
	 */
	public function generateImage() {
		try {
			if ($this->pixabayKey) {
				$generator = new PixabayImageURLGen($this->pixabayKey);
				return '<img class="' . $this->htmlClass . '" src="' . $generator->gen() . '"/>';
			}
		} catch (\Exception $ex) {
		}

		return null;
	}

}