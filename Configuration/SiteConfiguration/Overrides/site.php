<?php

declare(strict_types=1);

use LiepsGmbH\Liepstypo3defaults\Backend\FluxContentTypeItems;

defined('TYPO3') or die();

// Flux registers this field; only its item label provider is replaced.
if (isset($GLOBALS['SiteConfiguration']['site']['columns']['flux_content_types']['config'])) {
    $GLOBALS['SiteConfiguration']['site']['columns']['flux_content_types']['config']['itemsProcFunc'] =
        FluxContentTypeItems::class . '->processContentTypeItems';
}
