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

        // Überprüfen, ob ein SEO-Titel gesetzt ist
        $seoTitle = $page['seo_title'] ?? '';

        if (!empty($seoTitle)) {
            // Wenn der SEO-Titel gesetzt ist, diesen verwenden
            $this->title .= $seoTitle;
        } else {
            // Ansonsten den Standard-Seitentitel verwenden
            $this->title .= $page['title'];
        }

        $this->title .= $separator;
    }
}
