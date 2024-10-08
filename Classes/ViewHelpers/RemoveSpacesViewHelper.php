<?php
namespace LiepsGmbH\Liepstypo3defaults\ViewHelpers;

use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper;

class RemoveSpacesViewHelper extends AbstractViewHelper
{
    public function initializeArguments(): void
    {
        $this->registerArgument('phone', 'string', 'The phone number to process', true);
    }

    public function render(): string
    {
        $phone = $this->arguments['phone'];
        return preg_replace('/\s+/', '', $phone);
    }
}

/* <a href="tel:{lieps:removeSpaces(phone: phone)}" title="{record.header} anrufen">{phone}</a> */
