<?php

/**
 * Extension Manager/Repository config file for ext "lieps_typo3_defaults".
 */
$EM_CONF[$_EXTKEY] = [
    'title' => 'LIEPS TYPO3 Defaults',
    'description' => '',
    'category' => 'templates',
    'constraints' => [
        'depends' => [
            'typo3' => '10.4.0-10.4.99',
            'fluid_styled_content' => '10.4.0-10.4.99',
            'rte_ckeditor' => '10.4.0-10.4.99',
        ],
        'conflicts' => [
        ],
    ],
    'autoload' => [
        'psr-4' => [
            'LiepsGmbh\\LiepsTypo3Defaults\\' => 'Classes',
        ],
    ],
    'state' => 'stable',
    'uploadfolder' => 0,
    'createDirs' => '',
    'clearCacheOnLoad' => 1,
    'author' => 'LIEPS GmbH',
    'author_email' => 'it-service@lieps.de',
    'author_company' => 'LIEPS GmbH',
    'version' => '1.0.0',
];
