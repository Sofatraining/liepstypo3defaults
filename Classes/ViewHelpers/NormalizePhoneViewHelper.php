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
            'Die Telefonnummer, die normalisiert werden soll',
            true
        );
    }

    public function render(): string
    {
        $input = $this->arguments['phone'] ?? '';
        $number = trim((string)$input);

        if ($number === '') {
            return '';
        }

        // 1. Optionale Vorwahl (0) in Klammern entfernen, z.B. +49 (0)30 ...
        $number = preg_replace('/\(\s*0\s*\)/u', '', $number);

        // 2. Alle weiteren Leerzeichen, Bindestriche, Schrägstriche und Klammern entfernen
        $number = preg_replace('/[ \-\(\)\/]+/u', '', $number);

        // 3. "00" am Anfang durch "+" ersetzen
        if (strpos($number, '00') === 0) {
            $number = '+' . substr($number, 2);
        }

        // 4. Falls bereits "+" am Anfang steht UND direkt danach erneut "00" steht, das "00" entfernen (Sonderfall "+0049..." -> "+49...")
        if (strpos($number, '+00') === 0) {
            $number = '+' . substr($number, 3);
        }

        // 5. Falls Nummer mit einfacher "0" beginnt (nationales Format), +49 voranstellen
        if (strpos($number, '0') === 0) {
            $number = '+49' . substr($number, 1);
        }

        // 6. Sicherheits-Trim, falls z.B. jemand "+ 49 ..." eingegeben hat
        $number = preg_replace('/[^\d\+]+/', '', $number);

        // 7. Finale Format-Prüfung: + gefolgt von Ziffern
        if (!preg_match('/^\+[1-9][0-9]{3,14}$/', $number)) {
            // Keine gültige internationale Telefonnummer (min. 4, max. 15 Ziffern nach +)
            return '';
        }

        return $number;
    }
}


/* <a href="tel:{lieps:normalizePhone(phone: phone)}" title="" anrufen">{phone}</a> */
