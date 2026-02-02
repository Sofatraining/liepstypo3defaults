<?php
declare(strict_types=1);

namespace LiepsGmbH\Liepstypo3defaults\Seo;

use Doctrine\DBAL\ParameterType;
use Psr\Http\Message\ServerRequestInterface;
use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Utility\GeneralUtility;

final class TitleTagResolver
{
    /**
     * TypoScript USER userFunc signature:
     * resolve($content, $conf, $request)
     */
    public function resolve(string $content = '', array $conf = [], ?ServerRequestInterface $request = null): string
    {
        $request ??= ($GLOBALS['TYPO3_REQUEST'] ?? null);
        if (!$request instanceof ServerRequestInterface) {
            return '';
        }

        $qp = $request->getQueryParams();

        // ------------------------------------------------------------
        // 1) sf_event_mgt Detail (robust: verschiedene Param-Namen abdecken)
        // ------------------------------------------------------------
        $eventUid = (int)($qp['tx_sfeventmgt_pieventdetail']['event'] ?? 0);
        if ($eventUid <= 0) {
            $eventUid = (int)($qp['tx_sfeventmgt_pievent']['event'] ?? 0);
        }
        if ($eventUid <= 0) {
            $eventUid = (int)($qp['tx_sfeventmgt_pievent']['eventUid'] ?? 0);
        }

        if ($eventUid > 0) {
            $title = $this->fetchTitle('tx_sfeventmgt_domain_model_event', $eventUid);
            if ($title !== '') {
                return $title;
            }
        }

        // ------------------------------------------------------------
        // 2) news Detail (tx_news)
        // ------------------------------------------------------------
        $newsUid = (int)($qp['tx_news_pi1']['news'] ?? 0);
        if ($newsUid <= 0) {
            $newsUid = (int)($qp['tx_news_pi1']['newsUid'] ?? 0);
        }

        if ($newsUid > 0) {
            $title = $this->fetchTitle('tx_news_domain_model_news', $newsUid);
            if ($title !== '') {
                return $title;
            }
        }

        // Nicht zuständig -> TS ifEmpty greift (seo_title/title)
        return '';
    }

    private function fetchTitle(string $table, int $uid): string
    {
        $qb = GeneralUtility::makeInstance(ConnectionPool::class)->getQueryBuilderForTable($table);

        $row = $qb->select('title')
            ->from($table)
            ->where(
                $qb->expr()->eq('uid', $qb->createNamedParameter($uid, ParameterType::INTEGER)),
                $qb->expr()->eq('deleted', 0),
                $qb->expr()->eq('hidden', 0)
            )
            ->setMaxResults(1)
            ->executeQuery()
            ->fetchAssociative();

        return trim((string)($row['title'] ?? ''));
    }
}
