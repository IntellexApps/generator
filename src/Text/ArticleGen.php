<?php namespace Intellex\Generator\Text;

/**
 * Class ArticleGen generates a random article form random paragraphs.
 *
 * @package Intellex\Generator\Text
 */
class ArticleGen extends ParagraphGen {

	/** @var int Minimum number of paragraphs generated in the article. */
	private $min;

	/** @var int Maximum number of paragraphs generated in the article. */
	private $max;

	/**
	 * ArticleGen constructor.
	 *
	 * @param int $min Minimum number of paragraphs generated the article.
	 * @param int $max Maximum number of paragraphs generated the article.
	 */
	public function __construct($min = 5, $max = 10) {
		parent::__construct();
		$this->min = $min;
		$this->max = $max;
	}

	/**
	 * Generate a single article.
	 *
	 * @return string The generated article.
	 */
	public function gen() {
		$article = [];
		$length = rand($this->min, $this->max);
		$title = new SentenceGen(5, 25, false);
		$article[] .= $title->gen();
		while ($length--) {
			$article[] .= parent::gen();
		}
		return implode("\n\n", $article);
	}

}
