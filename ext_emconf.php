<?php

$EM_CONF[$_EXTKEY] = [
	'title' => 'LIEPS TYPO3 Defaults',
	'description' => '',
	'category' => 'templates',
	'author' => 'Jürgen Ohnesorge',
	'author_email' => 'it-service@lieps.de',
	'author_company' => 'LIEPS GmbH',
	'state' => 'stable',
	'clearCacheOnLoad' => 1,
	'version' => '2.0.9',
	'constraints' => [
		'depends' => [
			'typo3' => '11.5.0-11.5.99',
			'php' => '7.4.0-8.0.99',
			'fluid_styled_content' => '11.5.0-11.5.99',
			'flux' => '9.6.0-9.99.99',
			'vhs' => '6.1.0-6.99.99',
			'rte_ckeditor' => '11.5.0-11.5.99',
			'image_autoresize' => '2.1.0-2.99.99',
			'seo' => '11.5.0-11.5.99',
		],
		'conflicts' => [],
		'suggests' => [],
	],
	'autoload' => [
		'psr-4' => [
			'LiepsGmbH\\Liepstypo3defaults\\' => 'Classes',
		],
	],
];
