<?php

$EM_CONF[$_EXTKEY] = array (
	'title' => 'LIEPS TYPO3 Defaults',
	'description' => '',
	'category' => 'templates',
	'author' => 'Jürgen Ohnesorge',
	'author_email' => 'it-service@lieps.de',
	'author_company' => 'LIEPS GmbH',
	'state' => 'stable',
	'clearCacheOnLoad' => 1,
	'version' => '2.0.9',
	'constraints' => array (
		'depends' => array (
			'typo3' => '12.4.0-12.4.99',
			'php' => '7.4.0-8.1.99',
			'fluid_styled_content' => '12.4.0-12.4.99',
			'flux' => '10.0.0-10.0.99',
			'vhs' => '7.0.0-7.99.99',
			'rte_ckeditor' => '12.4.0-12.4.99',
			'image_autoresize' => '2.1.0-2.99.99',
			'seo' => '12.4.0-12.4.99',
		),
		'conflicts' => array (
    		),
		'suggests' => array (
    		),
	),
	'autoload' => array (
		'psr-4' => array (
			'LiepsGmbH\\Liepstypo3defaults\\' => 'Classes',
		),
	),
);
