<?php
defined('TYPO3') or die();

// Anpassen der Layout-Optionen für Elemente
$GLOBALS['TCA']['tt_content']['columns']['layout']['config']['items'] = array_merge(
    $GLOBALS['TCA']['tt_content']['columns']['layout']['config']['items'],
    [
        ['LIEPS 1', '4'],
        ['LIEPS 2', '5'],
        ['LIEPS 3', '6'],
    ]
);
