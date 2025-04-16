<?php

declare(strict_types=1);

namespace Samples;

use Toolkit\{Log, Check, Valid};

class sCard
{
    private const STYLES = [
        "card_color" => "Site.Style.BGColor.Card",
        "card_content_color" => "Site.Style.Text.Card.Content",
        "card_header_color" => "Site.Style.Text.Card.Header",
        "card_body_color" => "Site.Style.Text.Body",
    ];

    private static $resolvedStyles = [];

    public function __construct()
    {
        self::mapStylesToGlobals();
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

    private static function getResolvedStyle(string $key)
    {
        if (empty(self::$resolvedStyles)) {
            self::mapStylesToGlobals();
        }

        return self::$resolvedStyles[$key] ?? null;
    }

    public static function Translated(string $string = "", string $type = ""): string
    {
        return match ($type) {
            "Card" => self::Card($string),
            "Linked" => self::Linked($string),
            default => "",
        };
    }

    private static function Card(string $string): string
    {
        $cardColor = self::getResolvedStyle("card_body_color") ?? sTranslate::ROLE[$string]["color"];
        $respective = $string;

        if (isset(sTranslate::TRANSLATE[$string])) {
            return self::Blank([
                "color" => "cyan",
                "header" => sTranslate::TRANSLATE[$string]["title"],
                "text" => sTranslate::TRANSLATE[$string]["card"],
            ]);
        }

        return "";
    }

    private static function Linked(string $string): string
    {
        $respective = $string;
        $link = sprintf('<a data-link="%s">%s</a>', $respective, self::Card($string));
        return (isset(sTranslate::ROLE[$string]) && isset(sTranslate::TRANSLATE[$respective])) ||
            isset(sTranslate::TRANSLATE[$string])
            ? $link
            : "";
    }

    public static function Blank(array $array = []): string
    {
        $cardColor = self::getResolvedStyle("card_body_color") ?? $array["color"];
        $cardContentColor = self::getResolvedStyle("card_content_color") ?? "white";

        $elements = [
            "title" => isset($array["title"]) ? sprintf("<h2>%s</h2>", $array["title"]) : "",
            "text" => isset($array["text"]) ? sprintf('<p class="card-text">%s</p>', $array["text"]) : "",
            "button" => isset($array["button"]) ? sprintf("<center>%s</center>", $array["button"]) : "",
        ];

        return sprintf(
            '<div class="card-box text-%s">
                    %s
                    %s
                    %s
                </div>
            ',
            $cardContentColor,
            $elements["title"],
            $elements["text"],
            $elements["button"]
        );
    }

    public static function Fill(array $array = []): string
    {
        $cardColor = self::getResolvedStyle("card_body_color") ?? $array["color"];
        $cardContentColor = self::getResolvedStyle("card_content_color") ?? "white";
        $cardHeaderColor = self::getResolvedStyle("card_header_color") ?? "white";

        $elements = [
            "header" => isset($array["header"])
                ? sprintf('<div class="card-header text-%s">%s</div>', $cardHeaderColor, $array["header"])
                : "",
            "title" => isset($array["title"]) ? sprintf('<h5 class="card-title">%s</h5>', $array["title"]) : "",
            "text" => isset($array["text"]) ? sprintf('<p class="card-text">%s</p>', $array["text"]) : "",
            "button" => isset($array["button"]) ? $array["button"] : "",
        ];

        return sprintf(
            '<div class="card text-%s bg-%s m-2" %s>
                <div class="card-body text-%s">
                    %s
                    %s
                    %s
                </div>
            </div>',
            $cardHeaderColor,
            $cardColor,
            isset($array["bool"]) ? 'style="max-width: 18rem;"' : "",
            $cardContentColor,
            $elements["title"],
            $elements["text"],
            $elements["button"]
        );
    }

    public static function Collapsible(array $array = []): string
    {
        $accordionId = "accordion-" . md5((string) rand());
        $headingId = "heading-" . md5((string) rand());
        $collapseId = "collapse-" . md5((string) rand());
        $contHeader = $array["header"] ?? "";
        $contText = $array["content"] ?? "";
        $contAddButton =
            isset($array["path"]) && isset($array["addButton"]) && $array["addButton"]
                ? sForm::Add(["path" => $array["path"], "addNonModal" => $array["addNonModal"], "fa" => "plus-circle"])
                : "";

        if (Valid::vArray($array)) {
            return sprintf(
                '<div id="%s" class="mb-2 col-12">
                    <div class="card bg-%s">
                        <div class="d-flex flex-nowrap flex-column flex-sm-row m-1" id="%s">
                            <h5 class="mb-0 col-12 col-sm">
                                <button class="d-flex justify-content-sm-start justify-content-center col-12 btn btn-link collapsed text-%s" data-toggle="collapse" data-target="#%s" aria-expanded="false" aria-controls="%s">
                                    %s
                                </button>
                            </h5>
                            %s
                        </div>
                        <div id="%s" class="collapse" aria-labelledby="%s" data-parent="#%s">
                            <div class="card-body" style="color:%s">
                                %s
                            </div>
                        </div>
                    </div>
                </div>',
                $accordionId,
                self::getResolvedStyle("card_body_color"),
                $headingId,
                self::getResolvedStyle("card_content_color"),
                $collapseId,
                $collapseId,
                $contHeader,
                $contAddButton,
                $collapseId,
                $headingId,
                $accordionId,
                self::getResolvedStyle("card_content_color"),
                $contText
            );
        }

        return "";
    }
}
?>
