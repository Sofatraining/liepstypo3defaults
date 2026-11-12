<?php

/**
 * Extension Manager/Repository config file for ext "liepstypo3defaults".
 */
$EM_CONF[$_EXTKEY] = array (
    'title' => 'LIEPS TYPO3 Defaults',
    'description' => 'Bootstrap 5 Extension + Various Content Elements with Flux',
    'category' => 'fe',
    'version' => '5.0.0',
    'state' => 'stable',
    'uploadfolder' => false,
    'createDirs' => '',
    'clearCacheOnLoad' => true,
    'author' => 'Jürgen Ohnesorge',
    'author_email' => 'juergen.ohnesorge@me.com',
    'author_company' => 'LIEPS GmbH',
    'constraints' => 
    array (
        'depends' => 
            array (
                'typo3' => '14.3.11-14.3.99',
                'content_blocks' => '2.4.0-2.9.99',
                'flux' => '12.0.0-12.9.99',
                'vhs' => '8.0.0-8.9.99',
            ),
        'conflicts' => 
            array (
        ),
        'suggests' => 
            array (
        ),
    ),
    'autoload' => 
    array (
        'psr-4' => 
            array (
                'LiepsGmbH\\Liepstypo3defaults\\' => 'Classes',
        ),
    ),
);
