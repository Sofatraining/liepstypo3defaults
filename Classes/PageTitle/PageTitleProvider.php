<?php
namespace LiepsGmbH\Liepstypo3defaults\PageTitle;

use TYPO3\CMS\Core\PageTitle\AbstractPageTitleProvider;

class LiepsPageTitleProvider extends AbstractPageTitleProvider
{
	public function __construct()
	{	
		$this->title = '';
		$page = $GLOBALS['TSFE']->page;
		$separator = ' :';
		$this->title .= $page['title'];
		if ($key !== 0) {
			$this->title .= $separator;
		}
	}
}