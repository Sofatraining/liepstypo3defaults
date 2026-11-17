<?php

use LiepsGmbH\Liepstypo3defaults\Backend\FluxBackendLayoutItems;
defined('TYPO3') or die('Access denied.');
call_user_func(function()
{
    /**
     * Temporary variables
     */
    $extensionKey = 'liepstypo3defaults';

    /**
     * Default PageTS for Liepstypo3defaults
     */
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::registerPageTSConfigFile(
        $extensionKey,
        'Configuration/TsConfig/Page/All.tsconfig',
        'LIEPS TYPO3 Defaults'
    );
});

// Filter only the visible choices. Keep TYPO3's backend layout providers and
// the existing frontend layout mapping untouched.
foreach (['backend_layout', 'backend_layout_next_level'] as $field) {
    $GLOBALS['TCA']['pages']['columns'][$field]['config']['itemsProcFunc'] =
        FluxBackendLayoutItems::class . '->processBackendLayoutItems';
}
