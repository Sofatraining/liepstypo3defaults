<?php

/**
 * Extension Manager/Repository config file for ext "liepstypo3defaults".
 */
$EM_CONF[$_EXTKEY] = array (
    'title' => 'LIEPS TYPO3 Defaults',
    'description' => 'Bootstrap 5 Extension + Various Content Elements with Flux',
    'category' => 'fe',
    'version' => '4.0.7',
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
                'typo3' => '13.4.19-13.4.99',
                'content_blocks' => '1.3.18-1.9.99',
                'flux' => '11.1.0-12.1.99',
                'vhs' => '7.1.4-7.2.99',
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
