<?php

/**
 * Extension Manager/Repository config file for ext "liepstypo3defaults".
 */
$EM_CONF[$_EXTKEY] = array (
    'title' => 'LIEPS TYPO3 Defaults',
    'description' => 'Bootstrap 5 Extension + Various Content Elements with Flux',
    'category' => 'fe',
    'version' => '4.0.2',
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
                'typo3' => '11.5.0-13.4.99',
                'content_blocks' => '1.1.99-1.2.99',
                'flux' => '10.1.1-11.1.99',
                'vhs' => '7.0.7-7.1.99',
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
