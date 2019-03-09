<?php namespace Intellex\Generator\HTML;

use Intellex\Generator\Text\SentenceGen;

/**
 * Class HTMLSectionGen generates an HTML header with random paragraphs.
 *
 * @package Intellex\Generator\HTML
 */
class HTMLSectionGen extends HTMLParagraphGen {

	/** @var int The header level, as integer from 1 to 6. */
	private $headerLevel;

	/** @var int True to show header, false to skip it. */
	private $showHeader;

	/** @var int Minimum number of paragraphs in section. */
	private $minParagraphs;

	/** @var int Maximum number of paragraphs in section. */
	private $maxParagraphs;

	/** @var int Minimum number of subsections with a lower level. */
	private $minSubsections;

	/** @var int Maximum number of subsections with a lower level. */
	private $maxSubSections;

	/** @var int Maximum level the sections will propagate. */
	private $maxHeaderLevel;

	/**
	 * HTMLSectionGet constructor.
	 *
	 * @param int  $headerLevel    The header level, as integer from 1 to 6.
	 * @param bool $showHeader     True to show header, false to skip it.
	 * @param int  $minParagraphs  Minimum number of paragraphs in section.
	 * @param int  $maxParagraphs  Maximum number of paragraphs in section.
	 * @param int  $minSubsections Minimum number of subsections with a lower level.
	 * @param int  $maxSubSections Maximum number of subsections with a lower level.
	 * @param int  $maxHeaderLevel Maximum level the sections will propagate.
	 */
	public function __construct($headerLevel = 1, $showHeader = true, $minParagraphs = 2, $maxParagraphs = 4, $minSubsections = 0, $maxSubSections = 3, $maxHeaderLevel = 3) {
		parent::__construct();
		$this->headerLevel = $headerLevel;
		$this->showHeader = $showHeader;
		$this->minParagraphs = $minParagraphs;
		$this->maxParagraphs = $maxParagraphs;
		$this->minSubsections = $minSubsections;
		$this->maxSubSections = $maxSubSections;
		$this->maxHeaderLevel = $maxHeaderLevel;
	}

	/**
	 * Generate a headed section.
	 *
	 * @return string A valid HTML section with an optional header.
	 */
	public function gen() {
		$sections = [];

		// Header
		if ($this->showHeader) {
			$header = (new SentenceGen(4, 14, false))->gen();
			$sections[] = parent::tag('h' . $this->headerLevel, $header);
		}

		// Generate paragraphs
		$count = rand($this->minParagraphs, $this->maxParagraphs);
		while ($count--) {
			$sections[] = parent::gen();
		}

		// Generate subsections
		if ($this->headerLevel < $this->maxHeaderLevel) {
			$sectionCount = rand($this->minSubsections, $this->maxSubSections);
			while ($sectionCount--) {

				// Define the sub section
				$subSectionGenerator = (new HTMLSectionGen(
					$this->headerLevel + 1,
					$this->minParagraphs,
					$this->maxParagraphs,
					$this->minSubsections,
					$this->maxSubSections,
					$this->maxHeaderLevel
				))->setPixabayKey($this->pixabayKey);

				$sections[] = $subSectionGenerator->gen();
			}
		}

		return implode(PHP_EOL . PHP_EOL, $sections);
	}

}
