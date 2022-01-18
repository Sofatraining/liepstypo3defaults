<?php
defined('TYPO3') or die('Access denied.');
call_user_func(function()
{
    /**
     * Temporary variables
     */
    $extensionKey = 'lieps_typo3_defaults';

    /**
     * Default PageTS for LiepsTypo3Defaults
     */
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::registerPageTSConfigFile(
        $extensionKey,
        'Configuration/TsConfig/Page/All.tsconfig',
        'LIEPS TYPO3 Defaults'
    );
});
