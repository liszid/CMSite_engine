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
                    <ol class="breadcrumb">%s</ol>
                </nav>
            </div>',
            implode('', $breadcrumbItems)
        );
    }
}
