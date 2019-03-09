<?php namespace Intellex\Generator\HTML;

use Intellex\Generator\GeneratorInterface;

/**
 * Class HTMLArticleGen generates a complete HTML article.
 *
 * @package Intellex\Generator\HTML
 */
class HTMLArticleGen implements GeneratorInterface {

	/** @var bool True to include H1, false to skip it. */
	private $withH1;

	/** @var string API Key for Pixabay, or null to skip images. */
	private $pixabayKey;

	/**
	 * HTMLArticleGen constructor.
	 *
	 * @param bool $withH1 True to include H1, false to skip it
	 * @param string|null $pixabayKey API Key for Pixabay, or null to skip images.
	 */
	public function __construct($withH1 = true, $pixabayKey = null) {
		$this->withH1 = $withH1;
		$this->pixabayKey = $pixabayKey;
	}

	/**
	 * Set the key to use for Pixabay API.
	 *
	 * @param string $key API Key for Pixabay, or null to skip images.
	 *
	 * @return HTMLArticleGen Itself, for chaining.
	 */
	public function setPixabayKey($key) {
		$this->pixabayKey = $key;
		return $this;
	}

	/**
	 * Generate an HTML article.
	 *
	 * @return string The generated article.
	 */
	public function gen() {
		return (new HTMLSectionGen(1, $this->withH1))->setPixabayKey($this->pixabayKey)->gen();
	}

}
