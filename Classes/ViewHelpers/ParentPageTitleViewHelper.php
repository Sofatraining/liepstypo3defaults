<?php
declare(strict_types=1);
namespace LiepsGmbH\Liepstypo3defaults\ViewHelpers;

use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper;
use TYPO3\CMS\Core\Domain\Repository\PageRepository;
use TYPO3\CMS\Core\Utility\GeneralUtility;

class ParentPageTitleViewHelper extends AbstractViewHelper
{
    public function initializeArguments(): void
    {
        $this->registerArgument(
            'pid',
            'int',
            'Die UID der Ausgangsseite, deren Eltern-Seitentitel ermittelt werden soll',
            true
        );
    }

    public function render(): string
    {
        $pid = (int)$this->arguments['pid'];

        if ($pid <= 0) {
            return '';
        }
        $pageRepository = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Core\Domain\Repository\PageRepository::class);
        $parentPage = $pageRepository->getPage($pid);
        return $parentPage['title'] ?? '';

        $parentPage = $pageRepository->getPage($parentId);
        return $parentPage['title'] ?? '';
    }
}
