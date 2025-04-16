<?php

declare(strict_types=1);

namespace Samples;

use Toolkit\{Log, Check, Valid};

class sBreadcrumbs
{
    private const STYLES = [
        "card_color" => "Site.Style.BGColor.Card",
        "card_content_color" => "Site.Style.Text.Card.Content",
        "card_header_color" => "Site.Style.Text.Card.Header",
    ];

    private static $resolvedStyles = [];

    public function __construct()
    {
        self::mapStylesToGlobals();
    }

    private static function getResolvedStyle(string $key)
    {
        if (empty(self::$resolvedStyles)) {
            self::mapStylesToGlobals();
        }

        return self::$resolvedStyles[$key] ?? null;
    }

    private static function mapStylesToGlobals(): void
    {
        foreach (self::STYLES as $key => $globalPath) {
            $globalKeys = explode(".", $globalPath);
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

    public static function Prompt(string $string): string
    {
        $explode = explode("/", $string);
        $arrLength = count($explode);
        $arrString = "";
        $relPath = "";
        $breadcrumbItems = [];

        if (strcmp($string, "Home") !== 0) {
            $breadcrumbItems[] =
                '<li class="breadcrumb-item"><a data-link="Home">' . sTranslate::Prompt("Home") . "</a></li>";
        }

        foreach ($explode as $index => $segment) {
            $arrString = $relPath . $segment;
            $relPath .= $segment . "/";
            $activeClass = $index + 1 === $arrLength ? " active" : "";
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
                    <ol class="breadcrumb bg-%s text-%s">%s</ol>
                </nav>
            </div>',
            self::getResolvedStyle("card_color") ?? "light",
            self::getResolvedStyle("card_content_color") ?? "white",
            implode("", $breadcrumbItems)
        );
    }
}
?>
