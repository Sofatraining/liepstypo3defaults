<?php
defined('TYPO3') or die('Access denied.');
call_user_func(function()
{
    /**
     * Temporary variables
     */
    $extensionKey = 'liepstypo3defaults';

    /**
     * Default TypoScript for LiepsTypo3Defaults
     */
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile(
        $extensionKey,
        'Configuration/TypoScript',
        'LIEPS TYPO3 Defaults'
    );
});

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile('liepstypo3defaults', 'Configuration/TypoScript', 'LIEPS TYPO3 Defaults');
