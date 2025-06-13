<?php
declare(strict_types=1);
namespace LiepsGmbH\Liepstypo3defaults\ViewHelpers;

use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper;

final class NormalizePhoneViewHelper extends AbstractViewHelper
{
    public function initializeArguments(): void
    {
        $this->registerArgument(
            'phone',
            'string',
            'Telefonnummer, die formatiert werden soll',
            true
        );
    }

    public function render(): string
    {
        $phone = $this->arguments['phone'] ?? '';
        // Unerwünschte Zeichen (Leerzeichen, Bindestrich, Schrägstrich, Klammern) entfernen
        $cleaned = str_replace([' ', '-', '/', '(', ')'], '', $phone);
        // "0049" etc. am Anfang durch "+" ersetzen (internationales Format mit 00-Prefix)
        if (strpos($cleaned, '00') === 0) {
            $cleaned = '+' . substr($cleaned, 2);
        }
        // Lokale Rufnummer (beginnend mit einzelner 0) -> +49 voranstellen
        elseif (strpos($cleaned, '0') === 0) {
            $cleaned = '+49' . substr($cleaned, 1);
        }
        // Falls nach Bereinigung weder "+" noch "00" am Anfang stehen, "+" voranstellen
        if ($cleaned !== '' && $cleaned[0] !== '+') {
            $cleaned = '+' . $cleaned;
        }
        return $cleaned;
    }
}

/* <a href="tel:{lieps:normalizePhone(phone: phone)}" title="" anrufen">{phone}</a> */