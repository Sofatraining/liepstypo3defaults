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

// Setzen von Konstanten
$GLOBALS['TYPO3_CONF_VARS']['GFX']['imagefile_ext'] = 'gif,jpg,jpeg,tif,tiff,bmp,pcx,tga,png,pdf,ai,svg,webp';
$GLOBALS['TYPO3_CONF_VARS']['BE']['passwordReset'] = false;
$GLOBALS['TYPO3_CONF_VARS']['SYS']['systemLocale'] = 'de_DE.utf8';
$GLOBALS['TYPO3_CONF_VARS']['SYS']['locales']['default'] = 'de_DE';
