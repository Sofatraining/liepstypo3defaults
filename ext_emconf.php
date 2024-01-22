<?php

/**
 * Extension Manager/Repository config file for ext "liepstypo3defaults".
 */
$EM_CONF[$_EXTKEY] = array (
    'title' => 'LIEPS TYPO3 Defaults',
    'description' => 'Bootstrap 5 Extension + Various Content Elements with Flux',
    'category' => 'fe',
    'version' => '3.0.1',
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
                'typo3' => '11.5.0-12.4.99',
                'flux' => '10.0.7-10.0.99',
                'vhs' => '7.0.0-7.3.99',
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
