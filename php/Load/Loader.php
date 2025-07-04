<?php

declare(strict_types=1);

namespace Load;

use Toolkit\{Log, Check, Valid};

class Loader
{
    private static function getDirectoryItems(string $haystack, string $needle, string $mode): array
    {
        $list = [];
        $startsWith = function ($haystack, $needle) {
            $length = strlen($needle);
            return substr($haystack, 0, $length) === $needle;
        };
        $endsWith = function ($haystack, $needle) {
            $length = strlen($needle);
            if (!$length) {
                return true;
            }
            return substr($haystack, -$length) === $needle;
        };
        if (file_exists($haystack) && ($files = scandir($haystack))) {
            foreach ($files as $item) {
                switch ($mode) {
                    case "e":
                        if ($endsWith($item, $needle)) {
                            $list[] = $item;
                        }
                        break;
                    case "s":
                        if ($startsWith($item, $needle)) {
                            $list[] = $item;
                        }
                        break;
                }
            }
        }
        return $list;
    }

    protected static function directoryLoad(array $array, string $type): bool
    {
        $stackItems = self::getDirectoryItems($array["dir"], $array["type"], $array["mode"]);
        foreach ($stackItems as $item) {
            if (file_exists($array["dir"] . $item)) {
                if (!strcmp($type, "require")) {
                    require $array["dir"] . $item;
                } elseif (!strcmp($type, "require_once")) {
                    require_once $array["dir"] . $item;
                } elseif (!strcmp($type, "include")) {
                    include $array["dir"] . $item;
                } elseif (!strcmp($type, "include_once")) {
                    include_once $array["dir"] . $item;
                }
            }
        }
        return true;
    }

    protected static function fileLoad(array $array, string $type): bool
    {
        foreach ($array as $item) {
            if (file_exists($item)) {
                if (!strcmp($type, "require")) {
                    require $item;
                } elseif (!strcmp($type, "require_once")) {
                    require_once $item;
                } elseif (!strcmp($type, "include")) {
                    include $item;
                } elseif (!strcmp($type, "include_once")) {
                    include_once $item;
                }
            }
        }
        return true;
    }

    public static function CSS(string $string): string
    {
        $returnString = "<style>";

        foreach (self::getDirectoryItems($string, ".css", "e") as $i) {
            $returnString .= '@import url("' . $GLOBALS["Root"]["Path"] . $string . $i . '");';
        }

        $returnString .= "</style>";

        return $returnString;
    }

    public static function JS(string $string): string
    {
        $returnString = "";

        foreach (self::getDirectoryItems($string, ".js", "e") as $i) {
            $returnString .=
                "<script nonce='\${nonce}' type='text/javascript' language='javascript' src='" .
                $GLOBALS["Root"]["Path"] .
                $string .
                $i .
                "'></script>";
        }

        return $returnString;
    }

    public static function Favicon(string $string): string
    {
        $returnString = "";

        foreach (self::getDirectoryItems($string, "favicon", "s") as $i) {
            $returnString .=
                "<link rel='icon' type='image/png' href='" . $GLOBALS["Root"]["Path"] . $string . $i . "'>";
        }

        return $returnString;
    }
}
?>