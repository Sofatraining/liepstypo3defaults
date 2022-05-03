<?php

/**
 * Extension Manager/Repository config file for ext "liepstypo3defaults".
 */
$EM_CONF[$_EXTKEY] = [
	'title' => 'LIEPS TYPO3 Defaults',
	'description' => '',
	'category' => 'templates',
	'constraints' => [
		'depends' => [
			'typo3' => '11.5.0-11.5.99',
			'fluid_styled_content' => '11.5.0-11.5.99',
			'flux' => '9.6.0-9.99.99',
			'vhs' => '6.1.0-6.99.99',
			'mask' => '7.1.0-7.99.99',
			'image_autoresize' => '2.1.0-2.99.99',
			'powermail' => '10.1.0-10.99.99',
			'news' => '9.2.0-9.99.99',
			'seo' => '11.5.0-11.5.99',
			'rte_ckeditor' => '11.5.0-11.5.99',
		],
		'conflicts' => [
		],
		'suggests' => [
		],
	],
	'autoload' => [
		'psr-4' => [
			'LiepsGmbH\\Liepstypo3defaults\\' => 'Classes',
		],
	],
	'state' => 'stable',
	'uploadfolder' => 0,
	'createDirs' => '',
	'clearCacheOnLoad' => 1,
	'author' => 'Jürgen Ohnesorge',
	'author_email' => 'it-service@lieps.de',
	'author_company' => 'LIEPS GmbH',
	'version' => '2.0.1',
	'_md5_values_when_last_written' => 'a:0:{}',
	'suggests' => array(
	),
];
