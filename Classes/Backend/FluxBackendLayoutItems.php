<?php

declare(strict_types=1);

namespace LiepsGmbH\Liepstypo3defaults\Backend;

use TYPO3\CMS\Backend\View\BackendLayoutView;
use TYPO3\CMS\Core\Exception\SiteNotFoundException;
use TYPO3\CMS\Core\Site\SiteFinder;
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * Restrict this extension's PageTS backend layouts to Flux's site-level
 * page-template selection. The backend layout identifier is deliberately
 * unchanged: the existing pagelayout -> Fluid template mapping depends on it.
 */
final class FluxBackendLayoutItems
{
    private const TEMPLATE_TO_LAYOUT = [
        '010' => 'pagets__0_1_0',
        '020' => 'pagets__0_2_0',
        '030' => 'pagets__0_3_0',
        '110' => 'pagets__1_1_0',
        '120' => 'pagets__1_2_0',
        '130' => 'pagets__1_3_0',
        '111' => 'pagets__1_1_1',
        '121' => 'pagets__1_2_1',
        '131' => 'pagets__1_3_1',
    ];

    public function processBackendLayoutItems(array &$parameters): void
    {
        // Preserve TYPO3's full layout discovery, icons, exclusions and defaults.
        GeneralUtility::makeInstance(BackendLayoutView::class)->addBackendLayoutItems($parameters);

        $row = (array)($parameters['row'] ?? []);
        $pageId = (int)($row['uid'] ?? 0);
        if ($pageId <= 0) {
            // New records do not have a reliable site context yet.
            $pageId = (int)($row['pid'] ?? 0);
        }
        if ($pageId <= 0) {
            return;
        }

        try {
            $site = GeneralUtility::makeInstance(SiteFinder::class)->getSiteByPageId($pageId);
        } catch (SiteNotFoundException) {
            return;
        }

        $configuredTemplates = $site->getConfiguration()['flux_page_templates'] ?? [];
        $configuredTemplates = is_array($configuredTemplates)
            ? $configuredTemplates
            : GeneralUtility::trimExplode(',', (string)$configuredTemplates, true);

        // Flux semantics: an empty selection means ALL templates are available.
        if ($configuredTemplates === []) {
            return;
        }

        $permittedLayouts = [];
        foreach ($configuredTemplates as $configuredTemplate) {
            if (!is_scalar($configuredTemplate)) {
                continue;
            }
            $value = (string)$configuredTemplate;
            foreach (self::TEMPLATE_TO_LAYOUT as $template => $layout) {
                // Flux identifiers are normally ExtensionName->TemplateName.
                // Also accept the underscore identifiers from site configuration.
                if ($value === $template
                    || str_ends_with($value, '->' . $template)
                    || str_ends_with($value, '_' . $template)
                    || str_ends_with($value, '/' . $template)
                ) {
                    $permittedLayouts[$layout] = true;
                }
            }
        }

        // Do not affect third-party backend layouts or TYPO3's empty/none items.
        $ourLayouts = array_fill_keys(array_values(self::TEMPLATE_TO_LAYOUT), true);
        $parameters['items'] = array_values(array_filter(
            (array)($parameters['items'] ?? []),
            static function (array $item) use ($ourLayouts, $permittedLayouts): bool {
                $value = (string)($item['value'] ?? $item[1] ?? '');
                return !isset($ourLayouts[$value]) || isset($permittedLayouts[$value]);
            }
        ));
    }
}
