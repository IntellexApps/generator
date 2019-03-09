<?php namespace Intellex\Generator\Plus;

use Intellex\Generator\GeneratorInterface;

/**
 * Class GpsLocationGen generates a GPS location, within a supplied radius of a given central
 * point. Output format is <decimal>,<decimal>, with a maximum of 6 decimal digit precision.
 *
 * @package Intellex\Generator\Plus
 */
class GpsLocationGen implements GeneratorInterface {

	/** @const int How much meters per degree. */
	const METERS_PER_DEGREE = 111000;

	/** @var float Geographic latitude for a central point, around which random location will be generated. */
	private $latitude;

	/** @var float Geographic longitude for a central point, around which random location will be generated. */
	private $longitude;

	/** @var int Maximum distance for the random GPS location from the central point, in meters. */
	private $distance;

	/**
	 * GpsLocationGen constructor.
	 *
	 * @param float $latitude  Geographic latitude for a central point, around which random
	 *                         location will be generated.
	 * @param float $longitude Geographic longitude for a central point, around which random
	 *                         location will be generated.
	 * @param int   $distance  Maximum distance for the random GPS location from the central point,
	 *                         in meters.
	 */
	public function __construct($latitude = 37.7563002, $longitude = -122.4445029, $distance = 5000) {
		$this->latitude = $latitude;
		$this->longitude = $longitude;
		$this->distance = $distance;
	}

	/**
	 * Generate a GPS location.
	 *
	 * @return string GPS location in format: '<decimal>,<decimal>'.
	 */
	public function gen() {

		// Calculate a random point, by going a random distance in a random direction
		$dist = rand(0, 100000) / 100000;
		$angle = 2 * M_PI * rand(0, 100000) / 100000;
		$lat = $this->latitude + $this->distance / static::METERS_PER_DEGREE * $dist * cos($angle);
		$lon = $this->longitude + $this->distance / static::METERS_PER_DEGREE * $dist * sin($angle);

		// Format
		return join(',', [
			number_format($lat, 6, '.', ','),
			number_format($lon, 6, '.', ',')
		]);
	}

}