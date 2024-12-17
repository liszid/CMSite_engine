<?php

declare(strict_types=1);

namespace Samples;

use Toolkit\{
    Log,
    Check,
    Valid
};


/**
 * @update 2024.12.11
 * @author Liszi Dániel 
 * */

class sBreadcrumbs
{
    private const STYLES = [
        'card_color' => 'Site.Style.BGColor.Card',
        'card_content_color' => 'Site.Style.Text.Card.Content',
        'card_header_color' => 'Site.Style.Text.Card.Header',
    ];

    private static $resolvedStyles = [];

    public function __construct()
    {
        self::mapStylesToGlobals();
    }
    
    /**
     * Returns the resolved style for the given key.
     *
     * @param string $key
     * @return mixed
     * @author Liszi Dániel
     */
    private static function getResolvedStyle(string $key)
    {
        if (empty(self::$resolvedStyles)) {
            self::mapStylesToGlobals();
        }
        
        return self::$resolvedStyles[$key] ?? null;
    }

    /**
     * Maps self::STYLES array to corresponding GLOBALS values.
     */
    private static function mapStylesToGlobals(): void
    {
        foreach (self::STYLES as $key => $globalPath) {
            $globalKeys = explode('.', $globalPath);
            $value = $GLOBALS;

            foreach ($globalKeys as $globalKey) {
                if (isset($value[$globalKey])) {
                    $value = $value[$globalKey];
                } else {
                    throw new \Exception("Invalid global path: {$globalPath}");
                }
            }
            self::$resolvedStyles[$key] = $value;
        }
    }
    
    /**
     * Generates breadcrumb bar
     *
     * @param string $string
     * @return string
     * @author Liszi Dániel
     * @date 2024.12.11
     */
    public static function Prompt(string $string): string
    {
        $explode = explode('/', $string);
        $arrLength = count($explode);
        $arrString = '';
        $relPath = '';
        $breadcrumbItems = [];

        if (strcmp($string, 'Home') !== 0) {
            $breadcrumbItems[] = '<li class="breadcrumb-item"><a data-link="Home">' . sTranslate::Prompt('Home') . '</a></li>';
        }

        foreach ($explode as $index => $segment) {
            $arrString = $relPath . $segment;
            $relPath .= $segment . '/';
            $activeClass = ($index + 1 === $arrLength) ? ' active' : '';
            $breadcrumbItems[] = sprintf(
                '<li class="breadcrumb-item%s"><a data-link="%s">%s</a></li>',
                $activeClass,
                $arrString,
                sTranslate::Prompt($arrString)
            );
        }

        return sprintf(
            '<div class="col-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb bg-%s" style="color:%s">%s</ol>
                </nav>
            </div>',
            (self::getResolvedStyle('card_color')?? 'light'),
            (self::getResolvedStyle('card_content_color')?? 'white'),
            implode('', $breadcrumbItems)
        );
    }
}
