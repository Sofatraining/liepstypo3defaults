<?php
namespace LiepsGmbH\Liepstypo3defaults\ViewHelpers;

use TYPO3\CMS\Core\Utility\DebugUtility;

class FalReferenceViewHelper extends \TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper {
	/**
	 * @var bool
	 */
	protected $escapeOutput = false;

	/**
	 * Initialize arguments.
	 *
	 */
	public function initializeArguments()
	{
		$this->registerArgument('referenceUid', 'integer', 'File reference uid', false, 0);
	}

	/**
	 * Return file reference
	 *
	 * @return \TYPO3\CMS\Core\Resource\FileReference|null
	 */
	public function render()
	{
		$referenceUid = $this->arguments['referenceUid'];
		if(!$referenceUid) {
			$referenceUid = (int) $this->renderChildren();
		}
		$fileReferenceData = $GLOBALS['TSFE']->sys_page->checkRecord('sys_file_reference', $referenceUid);
		$fileReference = $fileReferenceData ? \TYPO3\CMS\Core\Resource\ResourceFactory::getInstance()->getFileReferenceObject($referenceUid) : null;
		return $fileReference;
	}
}