<?php require '../vendor/autoload.php';

// Setup
$pixabayAPIKey = '';

// Default config for all generator tests
$defaultConfig = [
	'count' => 12,
	'show'  => function ($result) {
		return "<pre class=\"gen-test\">{$result}</pre>";
	}
];

// Define tests
$tests = [
	'Core' => [
		'Hardcoded'            => [
			'9022'    => [ 9022 ],
			'A value' => [ 'A value' ]
		],
		'Boolean'              => [
			null        => function ($result) {
				return $result
					? '<span style="color: green; font-family: monospace;">true</span>'
					: '<span style="color: red; font-family: monospace;">false</span>';
			},
			'50% true'  => [],
			'80% true'  => [ 0.8 ],
			'100% true' => [ 100 ],
		],
		'Numeric'              => [
			'1 - 100'     => [],
			'1 - 2'       => [ 1, 2 ],
			'0 - 1000000' => [ 0, 1000000 ],
		],
		'String'               => [
			'6 - 12 Digits'                    => [ 6, 12, \Intellex\Generator\Core\StringGen::DIGITS ],
			'0 - 3 Uppercase letters'          => [ 0, 3, \Intellex\Generator\Core\StringGen::UPPERCASE ],
			'64 random characters'             => [ 64, 64, \Intellex\Generator\Core\StringGen::CRYPTO ],
			'With prefix `__`'                 => [ 6, 8, \Intellex\Generator\Core\StringGen::LETTERS, '__' ],
			'With suffix `()`'                 => [ 6, 8, \Intellex\Generator\Core\StringGen::LETTERS, null, '()' ],
			'With prefix `{{` and suffix `}}`' => [ 6, 8, \Intellex\Generator\Core\StringGen::LETTERS, '{{', '}}' ],
		],
		'Item'                 => [
			'1, 2, 3'                                    => [ [ 1, 2, 3 ] ],
			'Alpha, Beta, Charlie, Delta, Echo, Foxtrot' => [ [ 'Alpha', 'Beta', 'Charlie', 'Delta', 'Echo', 'Foxtrot' ] ],
		],
		'WeightedItem'         => [
			'2 is twice than 1' => [ [ 2 => 2, 1 => 1 ] ],
			'A:7, B:2, C:1'     => [ [ 'A' => 9, 'B' => 2, 'C' => 1 ] ]
		],
		'GaussianDistribution' => [
			'Around 10' => [ 10, 8 ],
			'Age'       => [ 34, 15, 0 ],
		],
	],
	'Time' => [
		'Timestamp' => [
			'-6M, now (default)'      => [],
			'today'                   => [ 'today', 'tomorrow' ],
			'20th century, formatted' => [ '1900-01-01', '1999-12-31', 'M Y' ],
		],
		'Time'      => [
			'with seconds (default)' => [],
			'no seconds'             => [ false ],
			'space as split'         => [ true, ' ' ],
		],
		'Date'      => [
			'-6M, now (default)' => [],
			'today or yesterday' => [ 'yesterday', 'tomorrow' ],
			'20th century'       => [ '1900-01-01', '1999-12-31' ],
		],
		'DateTime'  => [
			'-6M, now (default)' => [],
			'today or yesterday' => [ 'yesterday', 'tomorrow' ],
			'20th century'       => [ '1900-01-01', '1999-12-31' ],
		],
	],
	'Plus' => [
		'GpsLocation'     => [
			null                      => function ($result) {
				$encodedLocation = urlencode($result);
				//				$apiKey = 'XXX';
				//				return "<img style=\"width: 600px; height: 300px;\" src=\"https://maps.googleapis.com/maps/api/staticmap?size=600x300&zoom-13&center={$encodedLocation}size=600x300&maptype=roadmap&markers={$encodedLocation}&key={$apiKey}\" />";
				return "<a href=\"https://www.google.com/search?q={$encodedLocation}\" target=\"_blank\">{$result}</a>";
			},
			'San Francisco (default)' => [],
			'Amsterdam'               => [ 52.3677607, 4.8785829, 2400 ]
		],
		'PixabayImageURL' => [
			null                          => function ($result) {
				return "<img src=\"{$result}\" alt=\"$result\" />";
			},
			'(default)'                   => [ $pixabayAPIKey ],
			'Kittens, smaller resolution' => [ $pixabayAPIKey, [ 'q' => 'kittens' ], 180 ]
		],
	],
	'Text' => [
		'Word'      => [
			'(default)' => [],
		],
		'Sentence'  => [
			'5 - 25, dot, comma (default)' => [],
			'2 - 4 words'                  => [ 2, 4, false, false ],
			'1 - 8 words, with dot'        => [ 2, 4, true, false ],
			'12 words, with comma'         => [ 12, 12, false, true ],
		],
		'Paragraph' => [
			'8 - 12, few lists (default)' => [],
			'10 - 20, no lists'           => [ 10, 20, 0, 0 ],
			'5 - 8, 40% are OL'           => [ 5, 8, 0.4, 0 ],
			'1 - 9, 40% are UL'           => [ 1, 9, 0, 0.4 ],
		],
		'Article'   => [
			'5 - 10 (default)' => [],
			'1 - 20'           => [ 1, 20 ]
		],
	],
	'HTML' => [
		'HTMLSentence'  => [
			null        => function ($result) {
				return $result;
			},
			'(default)' => [],
		],
		'HTMLParagraph' => [
			null        => function ($result) {
				return $result;
			},
			'(default)' => [],
		],
		'HTMLSection'   => [
			null        => function ($result) {
				return $result;
			},
			'(default)' => [],
		],
		'HTMLArticle'   => [
			null        => function ($result) {
				return $result;
			},
			'(default)' => [ true, $pixabayAPIKey ],
		],
	],
];
$config = [];

// Validate
if (!$pixabayAPIKey) {
	echo 'Please define the Pixabay API key at the top of this file.';
	exit(1);
}

// Run tests
$results = [];
foreach ($tests as $domain => $generators) {

	// Each generator in domain
	foreach ($generators as $generatorName => $cases) {

		// Load show function
		$localConfig = $defaultConfig;
		if (isset($cases[null])) {
			$localConfig['show'] = $cases[null];
			unset($cases[null]);
		}
		$config[$domain][$generatorName] = $localConfig;

		// Each case for generator
		foreach ($cases as $caseName => $params) {

			/** @var \Intellex\Generator\GeneratorInterface $generatorInstance */
			$generatorClassName = "\\Intellex\\Generator\\{$domain}\\{$generatorName}Gen";
			if (class_exists($generatorClassName)) {
				$generatorInstance = new $generatorClassName(...$params);

				// Run
				for ($i = 0; $i < $localConfig['count']; $i++) {
					$results[$domain][$generatorName][$caseName][] = $generatorInstance->gen();
				}
			}
		}
	}
}

?>
<!DOCTYPE html>
<html lang="en_US">

<head>
	<meta charset="UTF-8">
	<title>Generator testing</title>

	<style>
		html, body { min-height: 100%; }
		.gen-test { font: normal 18px Arial; color: #434343; box-sizing: border-box; margin: 0; padding: 0; }
		pre.gen-test { font-family: monospace; white-space: pre-wrap; }

		/* Structure */
		aside.gen-test { width: 20%; height: 100%; overflow: auto; position: fixed; padding: 1em; }
		section.gen-test { width: 80%; margin-left: 20%; padding: 1em; }

		/* Menu */
		aside.gen-test h1.gen-test { font-size: 175%; margin: 1em 0 0.2em 0; }
		aside.gen-test h2.gen-test { font-size: 150%; margin: 0.1em 0 0.2em 2em; }
		aside.gen-test h3.gen-test { font-size: 125%; margin-left: 3em; }
		aside.gen-test .gen-test.trigger { cursor: pointer; color: blue; }
		aside.gen-test .gen-test.trigger:hover { text-decoration: underline; }

		/* Results */
		section.gen-test .gen-test.results { display: none; }
		section.gen-test .gen-test.results.active { display: block; }
		section.gen-test h1 { font-size: 200%; }
		section.gen-test .list-item { padding: 1em; border-bottom: 5px solid #d82737; }
		section.gen-test .list-item:last-child { border-bottom: none; }
	</style>
</head>

<body>

<aside class="gen-test">
	<?php foreach ($results as $domain => $generators) { ?>
		<h1 class="gen-test"><?php echo $domain ?></h1>

		<?php foreach ($generators as $generatorName => $cases) { ?>
			<h2 class="gen-test"><?php echo $generatorName ?>Gen</h2>

			<?php foreach ($cases as $caseName => $test) { ?>
				<h3 class="gen-test trigger" data-target="<?php echo $domain . '$' . $generatorName . '$' . $caseName ?>">
					<?php echo $caseName ?>
				</h3>
			<?php } ?>
		<?php } ?>
	<?php } ?>
</aside>
<section class="gen-test">
	<?php foreach ($results as $domain => $generators) { ?>
		<?php foreach ($generators as $generatorName => $cases) { ?>
			<?php foreach ($cases as $caseName => $tries) { ?>
				<div class="gen-test results" data-name="<?php echo $domain . '$' . $generatorName . '$' . $caseName ?>">
					<h1 class="gen-test"><?php echo $domain . ', ' . $generatorName . 'Gen, ' . $caseName ?></h1>
					<div class="gen-test list">
						<?php foreach ($tries as $result) { ?>
							<div class="gen-test list-item">
								<?php echo $config[$domain][$generatorName]['show']($result) ?>
							</div>
						<?php } ?>
					</div>
				</div>
			<?php } ?>
		<?php } ?>
	<?php } ?>
</section>

<script>
	document.querySelectorAll('aside.gen-test .gen-test.trigger').forEach((trigger) => {
		trigger.onclick = function () {
			document.querySelectorAll('section.gen-test .gen-test.results').forEach((results) => {
				if (results.dataset.name !== trigger.dataset.target) {
					results.classList.remove('active')
				} else {
					results.classList.add('active')
				}
			});
		}
	});
</script>

</body>
</html>