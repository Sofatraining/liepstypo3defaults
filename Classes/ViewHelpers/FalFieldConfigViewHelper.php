<?php
declare(strict_types=1);

namespace LiepsGmbH\Liepstypo3defaults\ViewHelpers;
use Closure;
use TYPO3\CMS\Core\Resource\AbstractFile;
use TYPO3Fluid\Fluid\Core\Rendering\RenderingContextInterface;
use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper;
use TYPO3Fluid\Fluid\Core\ViewHelper\Traits\CompileWithRenderStatic;

class FalFieldConfigViewHelper extends AbstractViewHelper
{
    use CompileWithRenderStatic;

    public function initializeArguments(): void
    {
        parent::initializeArguments();
        $this->registerArgument('field', 'string', 'Name of the field', true);
        $this->registerArgument('allowedExtensions', 'string', 'Allowed extensions', false, $GLOBALS['TYPO3_CONF_VARS']['SYS']['mediafile_ext']);
        $this->registerArgument('required', 'bool', 'Is field required?', false, false);
        $this->registerArgument('multiple', 'bool', 'Allow multiple files?', false, false);
    }

    public static function renderStatic(
        array $arguments,
        Closure $renderChildrenClosure,
        RenderingContextInterface $renderingContext
    ): array {
        return [
            'foreign_table' => 'sys_file_reference',
            'foreign_field' => 'uid_foreign',
            'foreign_sortby' => 'sorting_foreign',
            'foreign_table_field' => 'tablenames',
            'foreign_match_fields' => [
                'fieldname' => $arguments['field'],
            ],
            'foreign_label' => 'uid_local',
            'foreign_selector' => 'uid_local',
            'minitems' => $arguments['required'] ? 1 : 0,
            'maxitems' => $arguments['multiple'] ? 100 : 1,
            'overrideChildTca' => [
                'columns' => [
                    'uid_local' => [
                        'config' => [
                            'appearance' => [
                                'elementBrowserType' => 'file',
                                'elementBrowserAllowed' => $arguments['allowedExtensions'],
                            ],
                        ],
                    ],
                ],
                'types' => [
                    AbstractFile::FILETYPE_UNKNOWN => [
                        'showitem' => ' --palette--;;basicoverlayPalette, --palette--;;filePalette',
                    ],
                    AbstractFile::FILETYPE_TEXT => [
                        'showitem' => ' --palette--;;basicoverlayPalette, --palette--;;filePalette',
                    ],
                    AbstractFile::FILETYPE_IMAGE => [
                        'showitem' => ' --palette--;;imageoverlayPalette, --palette--;;filePalette',
                    ],
                    AbstractFile::FILETYPE_AUDIO => [
                        'showitem' => ' --palette--;;audioOverlayPalette, --palette--;;filePalette',
                    ],
                    AbstractFile::FILETYPE_VIDEO => [
                        'showitem' => ' --palette--;;videoOverlayPalette, --palette--;;filePalette',
                    ],
                    AbstractFile::FILETYPE_APPLICATION => [
                        'showitem' => ' --palette--;;basicoverlayPalette, --palette--;;filePalette',
                    ],
                ],
            ],
            'filter' => [
                [
                    'userFunc' => 'TYPO3\\CMS\\Core\\Resource\\Filter\\FileExtensionFilter->filterInlineChildren',
                    'parameters' => [
                        'allowedFileExtensions' => $arguments['allowedExtensions'],
                    ],
                ],
            ],
            'appearance' => [
                'useSortable' => true,
                'headerThumbnail' => [
                    'field' => 'uid_local',
                    'height' => '45m',
                ],
                'enabledControls' => [
                    'info' => true,
                    'new' => false,
                    'dragdrop' => true,
                    'sort' => false,
                    'hide' => true,
                    'delete' => true,
                ],
            ],
            'behaviour' => [
                'allowLanguageSynchronization' => true,
            ],
        ];
    }
}
