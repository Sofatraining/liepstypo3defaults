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
            'typo3' => '11.5.33-12.4.99',
            'fluid_styled_content' => '11.5.33-12.4.99',
            'rte_ckeditor' => '11.5.33-12.4.99',
            'flux' => '10.0.7-10.0.99',
            'vhs' => '7.0.0-7.3.99',
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
    'version' => '3.0.1',
];
