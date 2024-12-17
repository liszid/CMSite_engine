<?php

declare(strict_types=1);

namespace Samples;

use Toolkit\{Log, Check, Valid};

/**
 * @update 2024.12.11
 * @author Liszi Dániel
 */

class sFrame
{
    private static array $resolvedStyles = [];

    private static function mapStylesToGlobals(): void
    {
        $styles = [
            'bgColor' => 'Site.Style.Site.titleBgColor',
            'bgColorResolved' => 'Site.Style.BGColor',
            'textColor' => 'Site.Style.Text.Body',
            'headerTextColor' => 'Site.Style.Text.Header'
        ];

        foreach ($styles as $key => $globalPath) {
            self::$resolvedStyles[$key] = self::resolveGlobalPath($globalPath);
        }
    }

    private static function resolveGlobalPath(string $path)
    {
        $parts = explode('.', $path);
        $value = $GLOBALS;
        foreach ($parts as $part) {
            if (isset($value[$part])) {
                $value = $value[$part];
            } else {
                return null;
            }
        }
        return $value;
    }

    /**
     * Default Modal display function used on Pages
     *
     * @param array $array
     * @return string
     */
    public static function Modal(array $array = []): string
    {
        if (empty($array)) {
            return '';
        }

        $printButton = isset($array['print']) && $array['print']
            ? sprintf('<button class="btn btn-sm btn-warning mr-2" onclick="Instance.printElement(document.getElementById(\'printThis\'))"><i class="fa fa-print" aria-hidden="true"></i></button> ')
            : '';

        return sprintf(
            '<div class="modal-content">
                <div class="modal-header">
                    %s
                    %s
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    %s
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Bezár</button>
                </div>
            </div>',
            $printButton,
            sTranslate::Title($array['path'], 5),
            $array['content']
        );
    }

    /**
     * Default Page display function
     *
     * @param array $array
     * @return string
     */
    public static function Page(array $array = []): string
    {
        if (empty($array)) {
            return '';
        }

        self::mapStylesToGlobals();
        $bgColor = self::$resolvedStyles['bgColorResolved'][self::$resolvedStyles['bgColor']];
        $textColor = self::$resolvedStyles['textColor'];

        return sprintf(
            '<div class="mx-md-3 row pt-1 justify-content-center">
                <div class="d-none d-md-block col-11 pt-2">
                    %s
                </div>
                <div class="console-log col-sm-12 mx-4 col-md-9 mr-md-0 ml-md-0">
                    <div class="log-content">
                        <br />
                        <div class="col-12 mb-4 pb-4 text-%s">
                            %s
                        </div>
                    </div>
                </div>
            </div>',
            sBreadcrumbs::Prompt($array['path']),
            $textColor,
            $array['content']
        );
    }
}
