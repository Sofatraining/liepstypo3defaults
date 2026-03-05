<?php

declare(strict_types=1);

namespace LiepsGmbH\Liepstypo3defaults\ViewHelpers\Backend;

use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper;

final class FeGroupLabelViewHelper extends AbstractViewHelper
{
    public function initializeArguments(): void
    {
        parent::initializeArguments();
        $this->registerArgument('value', 'string', 'fe_group raw value (e.g. "-2,3,7")', false, '');
        $this->registerArgument('separator', 'string', 'Output separator', false, ' | ');
        $this->registerArgument('emptyLabel', 'string', 'Label if no restriction is set', false, '');
    }

    public function render(): string
    {
        $rawValue = trim((string)$this->arguments['value']);
        $separator = (string)$this->arguments['separator'];
        $emptyLabel = (string)$this->arguments['emptyLabel'];

        if ($rawValue === '' || $rawValue === '0') {
            return $emptyLabel;
        }

        $parts = array_values(array_filter(array_map('trim', explode(',', $rawValue)), static fn(string $v): bool => $v !== ''));
        if ($parts === []) {
            return $emptyLabel;
        }

        $labels = [];
        $groupUids = [];

        foreach ($parts as $part) {
            if ($part === '-2') {
                $labels[] = 'Anzeigen, wenn angemeldet';
                continue;
            }

            if ($part === '-1') {
                $labels[] = 'Verbergen, wenn angemeldet';
                continue;
            }

            if (ctype_digit($part)) {
                $groupUids[] = (int)$part;
                continue;
            }

            // Fallback für unbekannte Werte
            $labels[] = $part;
        }

        if ($groupUids !== []) {
            $groupTitlesByUid = $this->fetchFeGroupTitles($groupUids);

            // Reihenfolge wie in fe_group erhalten
            foreach ($groupUids as $uid) {
                if (isset($groupTitlesByUid[$uid]) && $groupTitlesByUid[$uid] !== '') {
                    $labels[] = $groupTitlesByUid[$uid];
                } else {
                    $labels[] = 'FE-Gruppe #' . $uid;
                }
            }
        }

        return implode($separator, $labels);
    }

    /**
     * @param int[] $uids
     * @return array<int, string>
     */
    private function fetchFeGroupTitles(array $uids): array
    {
        $uids = array_values(array_unique(array_filter($uids, static fn(int $uid): bool => $uid > 0)));
        if ($uids === []) {
            return [];
        }

        $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)->getQueryBuilderForTable('fe_groups');

        // Im Backend-Preview wollen wir auch versteckte/gelöschte Gruppen möglichst robust behandeln.
        $queryBuilder->getRestrictions()->removeAll();

        $rows = $queryBuilder
            ->select('uid', 'title')
            ->from('fe_groups')
            ->where(
                $queryBuilder->expr()->in(
                    'uid',
                    $queryBuilder->createNamedParameter($uids, \Doctrine\DBAL\ArrayParameterType::INTEGER)
                )
            )
            ->executeQuery()
            ->fetchAllAssociative();

        $result = [];
        foreach ($rows as $row) {
            $result[(int)$row['uid']] = (string)$row['title'];
        }

        return $result;
    }
}