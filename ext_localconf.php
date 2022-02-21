<?php
defined('TYPO3_MODE') || die();
/***************
 * Add default RTE configuration
 */
$GLOBALS['TYPO3_CONF_VARS']['RTE']['Presets']['liepstypo3defaults'] = 'EXT:liepstypo3defaults/Configuration/RTE/Default.yaml';

if (TYPO3_REQUESTTYPE & TYPO3_REQUESTTYPE_BE) {
    \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(
        \TYPO3\CMS\Core\Page\PageRenderer::class
    )->addRequireJsConfiguration([
        'shim' => [
            'ckeditor' => ['exports' => 'CKEDITOR']
        ],
        'paths' => [
            'ckeditor' => \TYPO3\CMS\Core\Utility\PathUtility::getAbsoluteWebPath(
                \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath('rte_ckeditor', 'Resources/Public/JavaScript/Contrib/')
            ) . 'ckeditor'
        ]
    ]);
}

/***************
 * PageTS
 */
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig('<INCLUDE_TYPOSCRIPT: source="FILE:EXT:liepstypo3defaults/Configuration/TsConfig/Page/All.tsconfig">');

\FluidTYPO3\Flux\Core::registerProviderExtensionKey('LiepsGmbH.Liepstypo3defaults', 'Page');
\FluidTYPO3\Flux\Core::registerProviderExtensionKey('LiepsGmbH.Liepstypo3defaults', 'Content');
