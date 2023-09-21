<?php
defined('TYPO3') or die('Access denied.');
/***************
 * Add default RTE configuration
 */
$GLOBALS['TYPO3_CONF_VARS']['RTE']['Presets']['liepstypo3defaults'] = 'EXT:liepstypo3defaults/Configuration/RTE/Default.yaml';

/***************
 * PageTS
 */
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig('<INCLUDE_TYPOSCRIPT: source="FILE:EXT:liepstypo3defaults/Configuration/TsConfig/Page/All.tsconfig">');

\FluidTYPO3\Flux\Core::registerProviderExtensionKey('LiepsGmbH.Liepstypo3defaults', 'Page');
\FluidTYPO3\Flux\Core::registerProviderExtensionKey('LiepsGmbH.Liepstypo3defaults', 'Content');
