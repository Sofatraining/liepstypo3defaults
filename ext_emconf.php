<?php

/**
 * Extension Manager/Repository config file for ext "liepstypo3defaults".
 */
$EM_CONF[$_EXTKEY] = [
    'title' => 'LIEPS TYPO3 Defaults',
    'description' => '',
    'category' => 'fe',
    'constraints' => [
        'depends' => [
            'typo3' => '12.4.0-12.4.99',
            'fluid_styled_content' => '12.4.0-12.4.99',
            'rte_ckeditor' => '12.4.0-12.4.99',
            'flux' => '10.0.7-10.0.99',
            'vhs' => '7.0.0-7.99.99',
        ],
        'conflicts' => [
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
    'author_email' => 'juergen.ohnesorge@me.com',
    'author_company' => 'LIEPS GmbH',
    'version' => '3.0.0',
];
