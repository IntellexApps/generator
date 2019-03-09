<?php namespace Intellex\Generator\Text;

use Intellex\Generator\Util;

/**
 * Class ParagraphGen generates a random paragraph from random sentences.
 *
 * @package Intellex\Generator
 */
class ParagraphGen extends SentenceGen {

	/** @var int Minimum number of sentences in a single paragraph. */
	private $min;

	/** @var int Maximum number of sentences in a single paragraph. */
	private $max;

	/** @var float Chance of generating a numbered list in paragraph, as a value between 0 and 1. */
	private $numberedListChance;

	/** @var float Chance of generating a bullet list in paragraph, as a value between 0 and 1. */
	private $bulletListChance;

	/**
	 * ParagraphGen constructor.
	 *
	 * @param int   $min                Minimum number of sentences in a single paragraph.
	 * @param int   $max                Maximum number of sentences in a single paragraph.
	 * @param float $numberedListChance ChanceChance of generating an ordered list in paragraph, as
	 *                                  a value between 0 and 1.
	 * @param float $bulletListChance   Chance of generating an unordered list in paragraph, as a
	 *                                  value between 0 and 1.
	 */
	public function __construct($min = 8, $max = 12, $numberedListChance = 0.09, $bulletListChance = 0.09) {
		parent::__construct();
		$this->min = $min;
		$this->max = $max;
		$this->numberedListChance = $numberedListChance;
		$this->bulletListChance = $bulletListChance;
	}

	/**
	 * Generate a single random paragraph.
	 *
	 * @return string The generated paragraph.
	 */
	public function gen() {
		$length = rand($this->min, $this->max);

		// Numbered list
		if (Util::should($this->numberedListChance)) {
			return implode(PHP_EOL, $this->generateNumberedList($length));
		}

		// Bullet list
		if (Util::should($this->bulletListChance)) {
			return implode(PHP_EOL, $this->generateBulletList($length));
		}

		// Only sentences, nothing special
		$paragraph = '';
		while ($length--) {
			$paragraph .= ($paragraph ? ' ' : null) . parent::gen();
		}

		return $paragraph;
	}

	/**
	 * Generate a random numbered list, starting from 1.
	 *
	 * @param int $count The number of items in the list.
	 *
	 * @return string[] The list elements.
	 */
	public function generateNumberedList($count) {
		$list = [];

		// Generate ordered list
		$index = 1;
		while ($count--) {
			$list[] = "{$index}. " . parent::gen();
			$index++;
		}

		return $list;
	}

	/**
	 * Generate a random bullet list.
	 *
	 * @param int    $count  The number of items in the list.
	 * @param string $bullet The bullet to use as a prefix for each item.
	 *
	 * @return string[] The list elements, with bullet as a prefix.
	 */
	public function generateBulletList($count, $bullet = '• ') {
		$list = [];

		// Generate ordered list
		while ($count--) {
			$list[] = $bullet . parent::gen();
		}

		return $list;
	}

}
