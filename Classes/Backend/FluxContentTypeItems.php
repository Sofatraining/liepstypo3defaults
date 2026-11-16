<?php

declare(strict_types=1);

namespace LiepsGmbH\Liepstypo3defaults\Backend;

use FluidTYPO3\Flux\Integration\FormEngine\SiteConfigurationProviderItems;
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * Replaces labels in Flux's site configuration selector without changing CType values.
 */
final class FluxContentTypeItems
{
    private const array LABELS = [
        'liepstypo3defaults_100-section-100' => 'Sektion',
        'liepstypo3defaults_102-columns-50-50' => '2 Spalten-Element',
        'liepstypo3defaults_105-columns-33-33-33' => '3 Spalten-Element',
        'liepstypo3defaults_106-columns-25-25-25-25' => '4 Spalten-Element',
        'liepstypo3defaults_accordion' => 'Bootstrap Accordion',
        'liepstypo3defaults_carousel' => 'Bootstrap Carousel',
        'liepstypo3defaults_example' => 'Beispiel-Inhalt',
        'liepstypo3defaults_offcanvas' => 'Bootstrap Offcanvas',
        'liepstypo3defaults_tabs' => 'Bootstrap Tabs',
    ];

    public function processContentTypeItems(array $parameters): array
    {
        // Preserve Flux's registered items and the underlying CType identifiers.
        $parameters = GeneralUtility::makeInstance(SiteConfigurationProviderItems::class)
            ->processContentTypeItems($parameters);

        if (!isset($parameters['items']) || !is_array($parameters['items'])) {
            return $parameters;
        }

        foreach ($parameters['items'] as &$item) {
            if (!is_array($item)) {
                continue;
            }

            $value = $item['value'] ?? $item[1] ?? null;
            if (!is_string($value) || !isset(self::LABELS[$value])) {
                continue;
            }

            if (array_key_exists('label', $item)) {
                $item['label'] = self::LABELS[$value];
            } else {
                $item[0] = self::LABELS[$value];
            }
        }
        unset($item);

        return $parameters;
    }
}
