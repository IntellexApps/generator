<?php require '../vendor/autoload.php';

use Intellex\Generator\Core\BooleanGen;
use Intellex\Generator\Core\GaussianDistributionGen;
use Intellex\Generator\Core\ItemGen;
use Intellex\Generator\Core\NumericGen;
use Intellex\Generator\Core\WeightedItemGen;
use Intellex\Generator\HTML\HTMLArticleGen;
use Intellex\Generator\Plus\PixabayImageURLGen;

// Setup
$pixabayAPIKey = '';

// Validate
if(!$pixabayAPIKey) {
	echo 'Please define the Pixabay API key at the top of this file.';
	exit(1);
}

// Image
echo '<img src="' . (new PixabayImageURLGen($pixabayAPIKey, [ 'q' => 'kitten' ], PixabayImageURLGen::SIZE_960))->gen() . '" />';

// GPS location within 3000 meters from the city centre of Amsterdam, Netherlands
(new \Intellex\Generator\Plus\GpsLocationGen(52.3677607, 4.8785829, 3000));

// Boolean with 50% chance of true
(new BooleanGen())->gen();

// Boolean with 80% chance of true
(new BooleanGen(0.8))->gen();

// Random number in range of 50 - 250
(new NumericGen(50, 250))->gen();

// Random number of mean 38 and mean 5 (Gaussian distribution)
(new GaussianDistributionGen(38, 4))->gen();

// Random item from array
(new ItemGen([ 1, 2, 3, 5, 7, 11 ]))->gen();

// Random weighted item from array, where is 2 times more likely than
// B and 6 times more likely than C.
(new WeightedItemGen([ 'A' => 6, 'B' => 3, 'C' => 1 ]))->gen();

// Full HTML article
(new HTMLArticleGen(true, $pixabayAPIKey))->gen();

// Full HTML article
(new HTMLArticleGen(true, $pixabayAPIKey))->gen();
