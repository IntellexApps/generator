<?php /** @noinspection SpellCheckingInspection */
namespace Intellex\Generator\Text;

use Intellex\Generator\Core\ItemGen;

/**
 * Class WordGen generates a single word, from a predefined "lorem ipsum" dictionary.
 *
 * @package Intellex\Generator
 */
class WordGen extends ItemGen {

	/** @var string[] The list of default words, where all have the same chance of being picked out. */
	private $defaultWords = [ 'lorem', 'ipsum', 'dolor', 'sit', 'amet', 'consectetur', 'adipiscing',
		'elit', 'sed', 'do', 'eiusmod', 'tempor', 'incididunt', 'ut', 'labore', 'et', 'dolore',
		'magna', 'aliqua', 'arcu', 'cursus', 'vitae', 'congue', 'mauris', 'rhoncus', 'tincidunt',
		'ornare', 'massa', 'eget', 'egestas', 'natoque', 'penatibus', 'magnis', 'dis', 'parturient',
		'montes', 'nascetur', 'ridiculus', 'mus', 'ac', 'turpis', 'maecenas', 'pharetra',
		'convallis', 'posuere', 'morbi', 'leo', 'lobortis', 'feugiat', 'vivamus', 'at', 'augue',
		'dui', 'felis', 'bibendum', 'tristique', 'hac', 'habitasse', 'platea', 'dictumst',
		'vestibulum', 'ullamcorper', 'lacus', 'suspendisse', 'faucibus', 'interdum', 'quis',
		'risus', 'vulputate', 'odio', 'enim', 'blandit', 'diam', 'euismod', 'in', 'pellentesque',
		'placerat', 'duis', 'ultricies', 'fermentum', 'sollicitudin', 'orci', 'phasellus', 'id',
		'velit', 'laoreet', 'donec', 'nibh', 'nisl', 'condimentum', 'venenatis', 'a', 'nulla',
		'porttitor', 'neque', 'aliquam', 'tellus', 'metus', 'eu', 'scelerisque', 'imperdiet',
		'proin', 'pretium', 'quam', 'dignissim', 'est', 'ante', 'urna', 'molestie', 'elementum',
		'facilisis', 'nunc', 'mi', 'sagittis', 'purus', 'semper', 'nec', 'praesent', 'libero',
		'viverra', 'accumsan', 'nisi', 'cras', 'sodales', 'nullam', 'consequat', 'quisque',
		'aliquet', 'mollis', 'tortor', 'justo', 'vel', 'sem', 'integer', 'sociis', 'forbid',
		'ultrices', 'gravida', 'varius', 'suscipit', 'auctor', 'non', 'volutpat', 'commodo',
		'fringilla', 'tempus', 'iaculis', 'nam', 'dictum', 'lectus', 'aenean', 'eleifend',
		'mattis', 'pulvinar', 'malesuada', 'rutrum', 'facilisi', 'etiam', 'curabitur', 'eros',
		'sapien', 'ligula', 'erat', 'lacinia', 'senectus', 'netus', 'fames', 'vehicula',
		'hendrerit', 'habitant', 'porta', 'fusce', 'luctus', 'dapibus', 'laborum', 'Intellex' ];

	/**
	 * WordGen constructor.
	 */
	public function __construct() {
		parent::__construct($this->defaultWords);
	}

}
