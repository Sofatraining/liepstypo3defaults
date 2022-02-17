<?php
if (!defined('TYPO3_MODE')) {
	die ('Access denied.');
}



\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile('liepstypo3defaults', 'Configuration/TsConfig/Page/All.tsconfig', 'LIEPS TYPO3 Defaults');
