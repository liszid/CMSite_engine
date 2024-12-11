<?php

declare(strict_types=1);

namespace Samples;

use Toolkit\{Log, Check, Valid};
use Load\Loader as Load;

/**
 * @update 2024.12.11
 * @author Liszi Dániel 
 * */

class sSite_Vertical
{
    private const STYLES = [
        'navbar_side_bg_color' => 'Site.Style.BGColor.Navbar_Side',
        'navbar_side_text_color' => 'Site.Style.Text.Navbar',
        'navbar_top_bg_color' => 'Site.Style.BGColor.Navbar_Top',
        'navbar_top_text_color' => 'Site.Style.Text.Navbar',
        'navbar_top_brand_color' => 'Site.Style.BGColor.Brand',
        'body_bg_color' => 'Site.Style.BGColor.Body',
        'footer_bg_color' => 'Site.Style.BGColor.Footer',
        'footer_text_color' => 'Site.Style.Text.Footer',
        'static_js_path' => 'Static.JS.path',
        'site_title' => 'Site.Content.Title',
    ];

    private static $resolvedStyles = [];

    public function __construct(array $array)
    {
        self::mapStylesToGlobals();
        echo self::Build($array);
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
     * Returns the resolved style for the given key.
     *
     * @param string $key
     * @return mixed
     */
    private static function getResolvedStyle(string $key)
    {
        if (empty(self::$resolvedStyles)) {
            self::mapStylesToGlobals();
        }
        
        return self::$resolvedStyles[$key] ?? null;
    }

    /**
     * Returns the Navigation bar of the HTML
     *
     * @return string
     */
    private static function Navbar_Side(array $array): string
    {
        if (empty($array)) {
            return '';
        }

        return sprintf(
            '<div class="p-0 m-0 coverIt">
                <nav id="collapsibleNavbar" class="sidebar position-sm-fixed collapse h-100 d-md-block bg-%s text-%s">
                    <div class="sticky-md-top pt-md-5 mx-2">
                        <ul class="nav flex-column mt-3">
                            %s
                        </ul>
                    </div>
                </nav>
            </div>',
            self::getResolvedStyle('navbar_side_bg_color'),
            self::getResolvedStyle('navbar_side_text_color'),
            self::Navbar_Items($array)
        );
    }

    /**
     * Sets the left part of the Navigation Bar
     *
     * @return string
     */
    private static function Navbar_Items(array $array): string
    {
        return array_reduce($array, fn($carry, $item) => $carry . self::Navbar_Generate($item), '');
    }

    /**
     * Sets the right side of the Navigation Bar
     *
     * @return string
     */
    private static function Navbar_Top(array $array): string
    {
        return sprintf(
            '<nav id="mainNavBar" class="navbar navbar-expand-lg navbar-%s bg-%s text-%s">
                <div class="container-fluid">
                    <a class="navbar-brand text-%s" data-link="Home">%s</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav ml-auto">
                            %s
                        </ul>
                    </div>
                </div>
            </nav>',
            self::getResolvedStyle('navbar_top_brand_color'),
            self::getResolvedStyle('navbar_top_bg_color'),
            self::getResolvedStyle('navbar_top_text_color'),
            self::getResolvedStyle('navbar_top_text_color'),
            self::getResolvedStyle('site_title'),
            self::Navbar_Generate($array['navbarRight'])
        );
    }

    /**
     * Used for displaying items at the navigation bar
     *
     * @param array $array
     *
     * @return string
     */
    private static function Navbar_Generate(array $array = []): string
    {
        $dataToggle = '';
        $dataItems = '';

        if ($array['dataToggle'] === true) {
            $dataToggle .= sprintf('data-link="%s" data-toggle="modal" data-target="#modalBox"', $array['dataLink']);
        } elseif ($array['dataToggle'] === 'dropdown') {
            $dataToggle .= 'href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"';
            $dataItems .= sprintf('<ul class="dropdown-menu" aria-labelledby="nav-%s">', $array['dataLink']);
            
            $dataItems .= implode('', array_map(fn($i) => sprintf('<li><a class="dropdown-item" data-link="%s/%s">%s</a></li>', $array['dataLink'], $i, $i), $array['dataItems']));

            $dataItems .= '</ul>';
        } else {
            $dataToggle .= sprintf('data-link="%s"', $array['dataLink']);
        }

        return sprintf(
            '<li class="nav-item %s">
                <a class="nav-link %s" id="nav-%s" %s>
                    <i class="fa fa-fw fa-%s"></i>
                    <span %s>%s</span>
                </a>%s
            </li>',
            $array['liClass'],
            $array['aClass'],
            $array['dataLink'],
            $dataToggle,
            $array['faClass'],
            ((isset($array['hidden']) && $array['hidden'] > 0)?'class="hideThis"' : '' ),
            $array['Desc'],
            $dataItems
        );
    }

    /**
     * Builds the site
     *
     * @return string
     */
    public static function Build(array $array): string
    {
        return sprintf(
            '<!DOCTYPE html>
            <html lang="en">
                %s
                <body>
                    %s
                    <div class="container-fluid p-0 m-0 bg-%s">
                        <div class="d-flex flex-column flex-sm-row flex-nowrap h-100">
                            %s
                            <main role="main" class="p-0 m-0 w-100 d-flex flex-column flex-nowrap" style="position:relative; top:-48px;">
                                <div id="body" class="my-md-5 position-relative" style="min-height:90vh">
                                </div>
                                <div id="modalBox" class="modal fade" role="dialog">
                                    <div class="modal-dialog modal-lg" id="modalDialog">
                                    </div>
                                </div>
                                <footer class="page-footer fixed-bottom font-small bg-%s text-%s">
                                    %s
                                </footer>
                                <resources>
                                    %s
                                </resources>
                            </main>
                        </div>
                    </div>
                </body>
            </html>',
            $array['header'],
            self::Navbar_Top($array),
            self::getResolvedStyle('body_bg_color'),
            !empty($array['navbarLeft']) ? self::Navbar_Side($array['navbarLeft']) : '',
            self::getResolvedStyle('footer_bg_color'),
            self::getResolvedStyle('footer_text_color'),
            $array['footer'],
            Load::JS(self::getResolvedStyle('static_js_path'))
        );
    }
}
