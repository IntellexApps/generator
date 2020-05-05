<?php namespace Intellex\Generator\Plus;

use Intellex\Generator\GeneratorInterface;
use Intellex\Pixabay\Data\Image;
use Intellex\Pixabay\Enum\Order;
use Intellex\Pixabay\Enum\Category;
use Intellex\Pixabay\Enum\ImageType;
use Intellex\Pixabay\ImageAPI;
use Intellex\Pixabay\SearchParams;

/**
 * Class PixabayImageURLGen generates a URL to a random image on the Pixabay free image
 * service, using their API.
 *
 * @package Intellex\Generator\Core
 */
class PixabayImageURLGen implements GeneratorInterface {

	/** @const int Size of 180, for max image width. */
	const SIZE_180 = 180;

	/** @const int Size of 340, for max image width. */
	const SIZE_340 = 340;

	/** @const int Size of 640, for max image width. */
	const SIZE_640 = 640;

	/** @const int Size of 960 (default), for max image width. */
	const SIZE_960 = 960;

	/** @var string API key for Pixabay. */
	private $apiKey;

	/** @var array Additional params for Pixabay API. */
	private $params;

	/** @var int $size Max image width, in pixels. Possible values are SIZE_180, SIZE_340, SIZE_640 or SIZE_960 (default). */
	private $size;

	/** @var Image[][] Cached images. */
	private static $cache = [];

	/**
	 * ImageGen constructor.
	 *
	 * @param string       $apiKey API key for Pixabay.
	 * @param int          $size   Max image width, in pixels. Possible values are SIZE_180,
	 *                             SIZE_340, SIZE_640, SIZE_960 or null to get the largest
	 *                             available from API (default).
	 * @param SearchParams $params Search parameters for Pixabay API.
	 */
	public function __construct($apiKey, $params = null, $size = null) {
		$this->apiKey = $apiKey;
		$this->size = $size;

		// Default search parameters for Pixabay API
		try {
			$this->params = (new SearchParams($params))
				->setSafeSearch(true)
				->setEditorsChoice(true)
				->setImageType(ImageType::PHOTO)
				->setCategory(Category::NATURE)
				->setOrder(Order::POPULAR)
				->setPerPage(200);
		} catch (\Exception $ex) {
		}
	}

	/**
	 * Get a URL to a random image from Pixabay.
	 *
	 * @return string Path to a random image on pixabay.
	 * @throws \Intellex\Pixabay\Exception\InvalidAPIKeyException
	 * @throws \Intellex\Pixabay\Exception\TooManyRequestsException
	 * @throws \Intellex\Pixabay\Exception\UnexpectedPixabayException
	 * @throws \Intellex\Pixabay\Exception\UnsupportedSearchParameterException
	 * @throws \Intellex\Pixabay\Validation\ValidationException
	 */
	public function gen() {
		$images = $this->fetch();

		$rand = rand(0, sizeof($images) - 1);
		return $this->getProperSize($images[$rand]);
	}

	/**
	 * Fetch the images from the API, but use cache to prevent flood exception on Pixabay API.
	 *
	 * @return Image[] The list of images.
	 * @throws \Intellex\Pixabay\Exception\InvalidAPIKeyException
	 * @throws \Intellex\Pixabay\Exception\TooManyRequestsException
	 * @throws \Intellex\Pixabay\Exception\UnexpectedPixabayException
	 * @throws \Intellex\Pixabay\Exception\UnsupportedSearchParameterException
	 * @throws \Intellex\Pixabay\Validation\ValidationException
	 */
	private function fetch() {

		// Check if exists
		$key = $this->getCacheKey();
		if (!key_exists($key, static::$cache)) {

			// Read from API
			$api = new ImageAPI($this->apiKey);
			static::$cache[$key] = $api->fetch($this->params)->hits;
		}

		return static::$cache[$key];
	}

	/**
	 * Get the unique key which represents this API request.
	 *
	 * @return string The unique string representing the API request.
	 */
	private function getCacheKey() {
		return md5($this->apiKey . '-cache-' . serialize($this->params));
	}

	/**
	 * Get the specified size of the image.
	 *
	 * @param Image $image The image to get size from.
	 *
	 * @return string The URL to the requested size.
	 */
	public function getProperSize($image) {
		switch ($this->size) {
			case 180:
				return $image->getURLForSize180();
			case 340:
				return $image->getURLForSize340();
			case 640:
				return $image->getURLForSize640();
			case 960:
				return $image->getURLForSize960();
			default:
				return $image->getLargeImage();
		}
	}

}
